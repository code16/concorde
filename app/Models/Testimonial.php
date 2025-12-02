<?php

namespace App\Models;

use Code16\OzuClient\Eloquent\IsOzuModel;
use Code16\OzuClient\Eloquent\Media;
use Code16\OzuClient\OzuCms\Form\OzuField;
use Code16\OzuClient\OzuCms\OzuCollectionConfig;
use Code16\OzuClient\OzuCms\OzuCollectionFormConfig;
use Code16\OzuClient\OzuCms\OzuCollectionListConfig;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Testimonial extends Model
{
    use IsOzuModel;
    /** @use HasFactory<\Database\Factories\ProjectFactory> */
    use HasFactory;

    public function authorPicture(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->withAttributes(['model_key' => 'authorPicture']);
    }

    public function logo(): MorphOne
    {
        return $this->morphOne(Media::class, 'model')
            ->withAttributes(['model_key' => 'logo']);
    }

    public static function configureOzuCollection(OzuCollectionConfig $config): OzuCollectionConfig
    {
        return $config
            ->setLabel('Testimonials')
            ->setHasPublicationState();
    }

    public static function configureOzuCollectionList(OzuCollectionListConfig $config): OzuCollectionListConfig
    {
        return $config->setIsReorderable();
    }

    public static function configureOzuCollectionForm(OzuCollectionFormConfig $config): OzuCollectionFormConfig
    {
        return $config
            ->configureTitleField(fn (OzuField $field) => $field->setLabel('Company name (hidden)'))
            ->hideCoverField()
            ->addCustomField(OzuField::makeText('author_name')->setLabel('Author name'))
            ->addCustomField(OzuField::makeText('author_role')->setLabel('Author role'))
            ->addCustomField(OzuField::makeImage('authorPicture')->setLabel('Author picture')->setCropRatio('1:1'))
            ->addCustomField(OzuField::makeImage('logo')->setLabel('Company logo')->setAllowedExtensions(['svg']));
    }
}
