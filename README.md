# README

![Build status](https://github.com/bresam/ivory-google-map/actions/workflows/build.yml/badge.svg)

[![Code Coverage](https://scrutinizer-ci.com/g/bresam/ivory-google-map/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/bresam/ivory-google-map/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/bresam/ivory-google-map/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/bresam/ivory-google-map/?branch=master)

[![Latest Stable Version](http://poser.pugx.org/ivory/google-map/v)](https://packagist.org/packages/ivory/google-map)
[![License](http://poser.pugx.org/ivory/google-map/license)](https://packagist.org/packages/ivory/google-map)
[![PHP Version Require](http://poser.pugx.org/ivory/google-map/require/php)](https://packagist.org/packages/ivory/google-map)

[![Total Downloads](http://poser.pugx.org/ivory/google-map/downloads)](https://packagist.org/packages/ivory/google-map)
[![Monthly Downloads](http://poser.pugx.org/ivory/google-map/d/monthly)](https://packagist.org/packages/ivory/google-map)
[![Daily Downloads](http://poser.pugx.org/ivory/google-map/d/daily)](https://packagist.org/packages/ivory/google-map)


## Quickstart
[Packagist: ivory/google-map](https://packagist.org/packages/ivory/google-map)

```composer require ivory/google-map``` 

### Symfony Bundle
[Github: ivory/google-map-bundle](https://github.com/bresam/ivory-google-map-bundle)

[Packagist: ivory/google-map-bundle](https://packagist.org/packages/ivory/google-map-bundle)

```composer require ivory/google-map-bundle``` 

### Contao Bundle

[Github: heimrichhannot/contao-google-maps-bundle](https://github.com/heimrichhannot/contao-google-maps-bundle)

[Packagist: heimrichhannot/contao-google-maps-bundle](https://packagist.org/packages/heimrichhannot/contao-google-maps-bundle)


## Overview

The Ivory Google Map project provides a Google Map integration for your PHP 7.2+ project. 
It allows you to manage map, controls, overlays, events & services through the Google Map API v3.

``` php
use Ivory\GoogleMap\Helper\Builder\ApiHelperBuilder;
use Ivory\GoogleMap\Helper\Builder\MapHelperBuilder;
use Ivory\GoogleMap\Map;

$map = new Map();

$mapHelper = MapHelperBuilder::create()->build();
$apiHelper = ApiHelperBuilder::create()
    ->setKey('API_KEY')
    ->build();

echo $mapHelper->render($map);
echo $apiHelper->render([$map]);
```

## Documentation

   - [Installation](/docs/installation.md)
   - [Usage](/docs/usage.md)
      - [Map](/docs/map.md)
      - [Controls](/docs/control/index.md)
         - [Map type](/docs/control/map_type.md)
         - [Rotate](/docs/control/rotate.md)
         - [Scale](/docs/control/scale.md)
         - [Street view](/docs/control/street_view.md)
         - [Zoom](/docs/control/zoom.md)
         - [Fullscreen](/docs/control/fullscreen.md)
         - [Custom](/docs/control/custom.md)
      - [Events](/docs/event.md)
      - [Layers](/docs/layer/index.md)
         - [Geo Json Layer](/docs/layer/geo_json_layer.md)
         - [Heatmap Layer](/docs/layer/heatmap_layer.md)
         - [Kml Layer](/docs/layer/kml_layer.md)
      - [Overlays](/docs/overlay/index.md)
         - [Marker](/docs/overlay/marker.md)
         - [Info Window](/docs/overlay/info_window.md)
         - [Info Box](/docs/overlay/info_box.md)
         - [Polyline](/docs/overlay/polyline.md)
         - [Encoded Polyline](/docs/overlay/encoded_polyline.md)
         - [Polygon](/docs/overlay/polygon.md)
         - [Rectangle](/docs/overlay/rectangle.md)
         - [Circle](/docs/overlay/circle.md)
         - [Ground Overlay](/docs/overlay/ground_overlay.md)
         - [Marker Clusterer](/docs/overlay/marker_clusterer.md)
      - [Places](/docs/place/index.md)
         - [Autocomplete](/docs/place/autocomplete.md)
      - [Rendering](/docs/helper/index.md)
         - [Map Rendering](/docs/helper/map.md)
         - [Static Map Rendering](/docs/helper/static_map.md)
         - [Places Autocomplete Rendering](/docs/helper/place_autocomplete.md)
         - [API Rendering](/docs/helper/api.md)
      - [Services](/docs/service/index.md)
         - [Direction](/docs/service/direction/direction.md)
         - [Distance Matrix](/docs/service/distance_matrix/distance_matrix.md)
         - [Elevation](/docs/service/elevation/elevation.md)
         - [Geocoder](/docs/service/geocoder/geocoder.md)
         - [Place](/docs/service/place/index.md)
            - [Autocomplete](/docs/service/place/autocomplete/place_autocomplete.md)
            - [Detail](/docs/service/place/detail/place_detail.md)
            - [Photo](/docs/service/place/photo/place_photo.md)
            - [Search](/docs/service/place/search/place_search.md)
         - [TimeZone](/docs/service/timezone/timezone.md)

## Testing

The library is fully unit tested by [PHPUnit](http://www.phpunit.de/).

## Contribute

We love contributors! Ivory is an open source project. If you'd like to contribute, feel free to propose a PR! You
can follow the [CONTRIBUTING](https://github.com/bresam/ivory-google-map/blob/master/.github/CONTRIBUTING.md) file which will explain you how to set up the project.

## License

The Ivory Google Map is under the MIT license. For the full copyright and license information, please read the
[LICENSE](/LICENSE) file that was distributed with this source code.
