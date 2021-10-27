# Usage

## Configure map

The Map is the central point of the library. It allows you to manipulate all available options. If you render the 
default map, the library will generate a map of 300px by 300px, centered on the coordinate (0, 0), configured with 
a zoom of 3 & using the default controls.

 - [Build a map](/docs/map.md#build)
 - [Configure variable](/docs/map.md#configure-variable)
 - [Configure html id](/docs/map.md#configure-html-id)
 - [Configure center & zoom](/docs/map.md#configure-center-&-zoom)
 - [Configure libraries](/docs/map.md#configure-libraries)
 - [Configure options](/docs/map.md#configure-options)
 - [Configure stylesheets](/docs/map.md#configure-stylesheets)

## Configure controls

The maps on Google Maps contain UI elements for allowing user interaction through the map. These elements are known as
controls and you can include variations of these controls in your Google Maps API application. Alternatively, you
can do nothing and let the Google Maps API handle all control behavior.

 - [Map Type](/docs/control/map_type.md)
 - [Rotate](/docs/control/rotate.md)
 - [Scale](/docs/control/scale.md)
 - [Street View](/docs/control/street_view.md)
 - [Zoom](/docs/control/zoom.md)
 - [Fullscreen](/docs/control/fullscreen.md)
 - [Custom](/docs/control/custom.md)
 
## Configure layers

Layers are objects on the map that consist of one or more separate items, but are manipulated as a single unit. Layers 
generally reflect collections of objects that you add on top of the map to designate a common association. Layers may 
also alter the presentation layer of the map itself, slightly altering the base tiles in a fashion consistent with the 
layer.

 - [Geo Json Layer](/docs/layer/geo_json_layer.md)
 - [Heatmap Layer](/docs/layer/heatmap_layer.md)
 - [Kml Layer](/docs/layer/kml_layer.md)

## Configure overlays

Overlays are objects on the map that are tied to latitude/longitude coordinates, so they move when you drag or zoom
the map. Overlays reflect objects that you "add" to the map to designate points, lines, areas, or collections of
objects.

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

## Configure events

Javascript within the browser is event driven, meaning that Javascript responds to interactions by generating events, 
and expects a program to listen to interesting events.

 - [Build an event](/docs/event.md#build)
 - [Configure instance](/docs/event.md#configure-instance)
 - [Configure handle](/docs/event.md#configure-handle)
 - [Append to a map](/docs/event.md#append-to-a-map)

## Render map

Once you have configured your map, you can render it:

- [Rendering](/docs/helper/index.md)
