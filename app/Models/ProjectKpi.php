<?php

namespace App\Models;

use Code16\OzuClient\Eloquent\IsOzuModel;
use Code16\OzuClient\OzuCms\Form\OzuEditorField;
use Code16\OzuClient\OzuCms\Form\OzuField;
use Code16\OzuClient\OzuCms\Form\OzuTextField;
use Code16\OzuClient\OzuCms\List\OzuColumn;
use Code16\OzuClient\OzuCms\OzuCollectionConfig;
use Code16\OzuClient\OzuCms\OzuCollectionFormConfig;
use Code16\OzuClient\OzuCms\OzuCollectionListConfig;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProjectKpi extends Model
{
    /** @use HasFactory<\Database\Factories\ProjectKpiFactory> */
    use HasFactory;
    use IsOzuModel;

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'parent_id');
    }

    public static function configureOzuCollection(OzuCollectionConfig $config): OzuCollectionConfig
    {
        return $config->setLabel('KPIs');
    }

    public static function configureOzuCollectionList(OzuCollectionListConfig $config): OzuCollectionListConfig
    {
        return $config
            ->setIsReorderable()
            ->addColumn(OzuColumn::makeText('title', 1)->setLabel('Figure'))
            ->addColumn(OzuColumn::makeText('suffix', 1)->setLabel('Suffix'))
            ->addColumn(OzuColumn::makeText('content', 10)->setLabel('Label'));
    }

    public static function configureOzuCollectionForm(OzuCollectionFormConfig $config): OzuCollectionFormConfig
    {
        return $config
            ->configureTitleField(fn (OzuTextField $field) => $field
                ->setLabel('Figure')
                ->setValidationRules([
                    'required',
                    'string',
                    'max:10'
                ])
            )
            ->configureContentField(fn (OzuEditorField $field) => $field
                ->setLabel('Label')
                ->hideToolbar()
                ->setHeight(50)
                ->setWithoutParagraphs()
                ->setValidationRules([
                    'required',
                    'string',
                    'max:100'
                ])
            )
            ->hideCoverField()
            ->addCustomField(
                OzuField::makeText('suffix')
                    ->setLabel('Suffix')
                    ->setValidationRules([
                        'string',
                        'nullable',
                        'max:10'
                    ])
                    ->setHelpMessage('For instance: k+')
            );
    }
}
