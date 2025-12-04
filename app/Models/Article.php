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
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Article extends Model
{
    /** @use HasFactory<\Database\Factories\ArticleFactory> */
    use HasFactory;
    use IsOzuModel;

    protected function casts(): array
    {
        return [
            'publication_date' => 'date',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(TeamMember::class, 'author_id');
    }

    public static function configureOzuCollection(OzuCollectionConfig $config): OzuCollectionConfig
    {
        return  $config
            ->setLabel('Articles')
            ->setIcon('far-newspaper')
            ->setHasPublicationState();
    }

    public static function configureOzuCollectionList(OzuCollectionListConfig $config): OzuCollectionListConfig
    {
        return $config
            ->addColumn(OzuColumn::makeText('title', 9)->setLabel('Titre'))
            ->addColumn(OzuColumn::makeDate('publication_date', 3)->setLabel('Publication date')->setDefaultSort('desc'));
    }

    public static function configureOzuCollectionForm(OzuCollectionFormConfig $config): OzuCollectionFormConfig
    {
        return $config
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
                    OzuEditorToolbarButton::File,
                    OzuEditorToolbarButton::Video,
                    OzuEditorToolbarButton::Iframe,
                    OzuEditorToolbarButton::Code,
                    OzuEditorToolbarButton::CodeBlock,
                ])
                ->setHeight(500, 1100)
            )
            ->addCustomField(OzuField::makeText('category_label')->setLabel('Category label'))
            ->addCustomField(
                OzuField::makeSelect('author_id')
                    ->setLabel('Auteur')
                    ->setOptions(TeamMember::where('active', true)->pluck('name', 'id')->toArray())
            )
            ->addCustomField(
                OzuField::makeDate('publication_date')
                    ->setLabel('Publication date')
                    ->setValidationRules([
                        'required',
                    ])
            );
    }

    public function url(): string
    {
        return route('articles.show', $this);
    }
}
