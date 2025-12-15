<?php

namespace App;

use Code16\OzuClient\OzuCms\Form\OzuField;
use Code16\OzuClient\OzuCms\OzuSettingsFormConfig;
use Code16\OzuClient\Support\Settings\OzuSiteSettings;

class GeneralSettings extends OzuSiteSettings
{
    public string $linkedin_url = 'https://fr.linkedin.com/company/code-16-web';
    public string $github_url = 'https://github.com/code16';
    public string $contact_email = 'contact@code16.fr';
    public string $address_street = '24 rue du Vieux-Marché-aux-Vins';
    public string $address_city = '67000 Strasbourg';

    public static function configureSettingsForm(OzuSettingsFormConfig $config): OzuSettingsFormConfig
    {
        return $config
            ->addSettingField(
                OzuField::makeText('linkedin_url')
                    ->setLabel('LinkedIn URL')
                    ->setValidationRules(['required', 'url'])
            )
            ->addSettingField(
                OzuField::makeText('github_url')
                    ->setLabel('Github URL')
                    ->setValidationRules(['required', 'url'])
            )
            ->addSettingField(
                OzuField::makeText('contact_email')
                    ->setLabel('Contact email')
                    ->setValidationRules(['required', 'email'])
            )
            ->addSettingField(
                OzuField::makeText('address_street')
                    ->setLabel('Address street')
                    ->setValidationRules(['required', 'string', 'max:200'])
            )
            ->addSettingField(
                OzuField::makeText('address_city')
                    ->setLabel('Address city')
                    ->setValidationRules(['required', 'string', 'max:200'])
            );
    }
}
