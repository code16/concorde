<?php

namespace App\Models;

use Code16\OzuClient\Eloquent\IsOzuModel;
use Code16\OzuClient\OzuCms\Form\OzuEditorField;
use Code16\OzuClient\OzuCms\Form\OzuEditorToolbarButton;
use Code16\OzuClient\OzuCms\Form\OzuField;
use Code16\OzuClient\OzuCms\List\OzuColumn;
use Code16\OzuClient\OzuCms\OzuCollectionConfig;
use Code16\OzuClient\OzuCms\OzuCollectionFormConfig;
use Code16\OzuClient\OzuCms\OzuCollectionListConfig;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function kpis(): HasMany
    {
        return $this->hasMany(ProjectKpi::class, 'parent_id')
            ->orderBy('order');
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
        return $config
            ->setLabel('Projects')
            ->setHasPublicationState()
            ->addSubCollection(ProjectKpi::class);
    }

    public static function configureOzuCollectionList(OzuCollectionListConfig $config): OzuCollectionListConfig
    {
        return $config
            ->setIsReorderable()
            ->setIsSearchable()
            ->addColumn(OzuColumn::makeText('title', 3)->setLabel('Titre'))
            ->addColumn(OzuColumn::makeText('heading_text', 9)->setLabel('Heading'));
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
            ->configureContentField(fn (OzuEditorField $field) => $field
                ->setToolbar([
                    OzuEditorToolbarButton::Heading1,
                    OzuEditorToolbarButton::Bold,
                    OzuEditorToolbarButton::Italic,
                    OzuEditorToolbarButton::Link,
                    OzuEditorToolbarButton::BulletList,
                    OzuEditorToolbarButton::Separator,
                    OzuEditorToolbarButton::Quote,
                    OzuEditorToolbarButton::Image,
                    OzuEditorToolbarButton::Video,
                    OzuEditorToolbarButton::Iframe,
                ])
                ->setHeight(500)
            )
            ->addCustomField(
                OzuField::makeSelect('tags')
                    ->setLabel('Tags')
                    ->setMultiple()
                    ->setOptions(ProjectTag::all()->pluck('label', 'id')->toArray())
            )
            ->addCustomField(
                OzuField::makeText('color')
                    ->setLabel('Color (hex)')
            );
    }
}
