---
title: How to customize Laravel API resources?
description: >-
  It may be for optimization, or to choose what data should be sent in different
  contexts.
date: 2020-09-28
thumbnail: /assets/img/posts/how-to-customize-laravel-api-resources/thumbnail.jpg
author: philippe
---

![](/assets/img/posts/how-to-customize-laravel-api-resources/thumbnail.jpg)

Laravel API resources are a great tool to format json resources to be returned by an API endpoint. If you are not familiar with this part of the framework, the [Laravel documentation](https://laravel.com/docs/8.x/eloquent-resources) will help you.

### A simple example

As a starting point, let’s say that in some API controller you have this index endpoint:

```php
class ProjectController 
{    
    public function index()
    {
        $projects = Project::where("status", "online")
            ->get();

        return ProjectResource::collection($projects);
    }
}
```

And the associated ProjectResource goes like this:

```php
class ProjectResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      "id" => $this->id,
      "name" => $this->name,
      "events" => EventResource::collection($this->events),
      "can" => [
          "update" => auth()->user()->can("update", $this->resource),
          "delete" => auth()->user()->can("delete", $this->resource)
      ]),
    ];
  }
}
```

### The n+1 problem

Clean and simple right? But if you are not careful, you may fall in a common issue: n+1 queries. Now the purpose of this post is not to introduce you to this particular problem, and you’ll find great [resources](https://pociot.dev/1-finding-n1-queries-in-laravel) and [packages](https://github.com/beyondcode/laravel-query-detector) to help you with this. In this case, a solution for the “events” relation would be to eager load the values in the controller:

```php
class ProjectController 
{    
    public function index()
    {
        $projects = Project::where("status", "online")
            ->with("events")
            ->get();

        return ProjectResource::collection($projects);
    }
}
```

But now, you will have to add this everywhere, and maybe there are cases where you don’t need to send the events with the projects. Well, Laravel resources handles this nicely, since you can check if the relation is eager loaded, in the resource:

```php
class ProjectResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      "id" => $this->id,
      "name" => $this->name,
      "events" => EventResource::collection($this->whenLoaded("events")),
      "can" => [
          "update" => auth()->user()->can("update", $this->resource),
          "delete" => auth()->user()->can("delete", $this->resource)
      ]),
    ];
  }
}
```

With this, if the events relation is loaded, the “events” key in the resource will contains all the data; and if not, the key will not be added in the first place. Very useful.

### Handle non direct relationships

But you know what? Sometimes this isn’t enough, and here’s a (real world) case: as you can see, in our example, we also add some keys (update and delete) related to policies (authorizations). These policies can be quite complicated, and can generate _a lot_ of N+1 queries on their side. This means we may need to eager load more relations; but as seen before in some cases we may not need to send these authorizations at all.

From here, the question is: how can we add a condition to add or not this part of the resource? Well there is a standard Laravel resource way to do this:

```php
class ProjectResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      "id" => $this->id,
      "name" => $this->name,
      "events" => EventResource::collection($this->whenLoaded("events")),
      $this->mergeWhen(
        $request->has("authorizations"),
        [
          "can" => [
            "update" => auth()->user()->can("update", $this->resource),
            "delete" => auth()->user()->can("delete", $this->resource)
          ]
        ]
      ),
    ];
  }
}
```

The `$this->mergeWhen()` trick allows to put a condition, which will be tested before adding or not all the “can” part. Problem solved!

### Or is it solved?

Well, not really (or at least: not in some cases). We still have 2 issues here:

First, even if `$request->has(“authorizations”)` is false, the “can” part will be executed, and the N+1 problem will still be there. The solution is to encapsulate the code in a Closure, since Laravel allows this trick in many places:

```php
class ProjectResource extends JsonResource
{
  public function toArray($request)
  {
    return [
      "id" => $this->id,
      "name" => $this->name,
      "events" => EventResource::collection($this->whenLoaded("events")),
      $this->mergeWhen(
        $request->has("authorizations"),
        function() {
          return [
            "can" => [
              "update" => auth()->user()->can("update", $this->resource),
              "delete" => auth()->user()->can("delete", $this->resource)
            ]
          ];
        }
      ),
    ];
  }
}
```

This simple Closure has a great effect: the “can” code _will not be executed_ if the merge test is false. And with this we are good to go. Unless…

### What if the condition is not in the request?

Yes, we said there are 2 issues. The second one is harder to solve: let’s say that the request does not know if we must add the authorization block or not. Here comes the purpose of this post: how to customize our resource? Well my advice is to add a chained setter:

```php
class ProjectResource extends JsonResource
{
  private bool $withAuthorizations = true;
  
  public function withAuthorizations(bool $withAuthorizations): self
  {
    $this->withAuthorizations = $withAuthorizations;
    
    return $this;
  }
  
  public function toArray($request)
  {
    return [
      "id" => $this->id,
      "name" => $this->name,
      "events" => EventResource::collection($this->whenLoaded("events")),
      $this->mergeWhen(
        $this->withAuthorizations,
        function() {
          return [
            "can" => [
              "update" => auth()->user()->can("update", $this->resource),
              "delete" => auth()->user()->can("delete", $this->resource)
            ]
          ];
        }
      ),
    ];
  }
}
```

With this code, the authorization block depends on an instance property (see line 21), and we can build a single ProjectResource like this:

```php
return (new ProjectResource($project))
  ->withAuthorizations(false);
```

Hooray! We won! We can now… but wait…

### Final boss: the collection problem

Yes, this trick is great for single resources (tipically in the show() method of our controller), but this will not work when calling `ProjectResource::collection(…)`: this is a static method. Luckily, Laravel allows us to create our own implementation of ProjectResourceCollection:

```php
class ProjectResourceCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
```

But how to interact here with each instance of ProjectResource? The idea would be to write something like this in our controller:

```php
class ProjectController 
{    
    public function index()
    {
        $projects = Project::where("status", "online")
            ->with("events")
            ->get();

        return (new ProjectResourceCollection($projects))
            ->withAuthorizations(false);
    }
}
```

Well, we’re almost there. To do this, let’s replicated what we’ve done in the ProjectResource, with a chained setter, and change a bit the “toArray()” method:

```php
class ProjectResourceCollection extends ResourceCollection
{
    private bool $withAuthorizations = true;
  
    public function withAuthorizations(bool $withAuthorizations): self
    {
        $this->withAuthorizations = $withAuthorizations;

        return $this;
    }

    public function toArray($request)
    {
        return $this->collection
            ->map->withAuthorizations($this->withAuthorizations)
            ->map->toArray($request)
            ->all();
    }
}
```

The `withAuthorizations()` part is the same as the one we built for the single resource. But notice the code of the `toArray()` method: here we pass the ProjectResourceCollection’s $withAuthorization property to each ProjectResource instance before calling each toArray().

### And voilà (as we really say in France. Incredible, something real in this fake world).

I hope this will help you to fix some resources; I’m using this code, or a variation of this, in my current projects, at [Code 16](https://code16.fr). If you want to get in touch with me, to discuss this or something related, feel free to [contact me on twitter](https://twitter.com/dvlpp).
