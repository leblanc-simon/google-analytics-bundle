# GoogleAnalyticsBundle

## Description

this bundle inject the Google Analytics javascript code when an ID is defined 

## Installation

* install the bundle

```bash
composer require leblanc-simon/google-analytics-bundle
```

* activate the bundle

```php
// app/AppKernel.php

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            // ...
            new LeblancSimon\GoogleAnalyticsBundle\LeblancSimonGoogleAnalyticsBundle(),
        ];
    }
}
```

Nothing else to do. The HTML will be automatically injected for the text/html response.

## Customization

### Configuration

you can customized the bundle with a configuration :

```yml
leblanc_simon_google_analytics:
    # The ID of the Google Analytics account
    id: Google Analytics ID
    # The template use in the injection
    template: 'LeblancSimonGoogleAnalyticsBundle::google_analytics.html.twig'

```

or just via ```parameters.yml``` (think to add it in the ```parameters.yml.dist```) :

```yml
google_analytics.id: 'Google Analytics ID'
```
