<?php

namespace App\Models;

use Code16\OzuClient\Eloquent\IsOzuModel;
use Code16\OzuClient\OzuCms\Form\OzuField;
use Code16\OzuClient\OzuCms\OzuCollectionConfig;
use Code16\OzuClient\OzuCms\OzuCollectionFormConfig;
use Code16\OzuClient\OzuCms\OzuCollectionListConfig;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;
    use IsOzuModel;

    protected function casts(): array
    {
        return [
            'tags' => 'array'
        ];
    }

    /** @var ProjectTag[] */
    public Collection $tags {
        get {
            return ProjectTag::query()
                ->whereIn('id', $this->getAttribute('tags'))
                ->get();
        }
    }

    public function url(): string
    {
        return route('projects.show', $this);
    }

    public static function configureOzuCollection(OzuCollectionConfig $config): OzuCollectionConfig
    {
        return $config->setLabel('Projects');
    }

    public static function configureOzuCollectionList(OzuCollectionListConfig $config): OzuCollectionListConfig
    {
        return $config;
    }

    public static function configureOzuCollectionForm(OzuCollectionFormConfig $config): OzuCollectionFormConfig
    {
        return $config
            ->addCustomField(
                OzuField::makeEditor('item_text')
                    ->setLabel('Item text')
                    ->setWithoutParagraphs()
                    ->hideToolbar()
            )
            ->addCustomField(
                OzuField::makeEditor('heading_text')
                    ->setLabel('Heading text')
                    ->setWithoutParagraphs()
                    ->hideToolbar()
            )
            ->addCustomField(
                OzuField::makeSelect('tags')
                    ->setLabel('Tags')
                    ->setMultiple()
                    ->setOptions(ProjectTag::all()->pluck('label', 'id')->toArray())
            );
    }
}
