var tileLayer = new mapboxgl.Map({
      container: 'tileLayer',
      style: 'https://api.maptiler.com/maps/streets/style.json?key=xwxHsc3dQ6fWqVxBQwaq',
      center: [111.34714, -7.65427],
      zoom: 9.28
    });

    tileLayer.on('load', function() {
      tileLayer.addSource('geojson-overlay', {
        'type': 'geojson',
        'data': 'https://api.maptiler.com/data/fbb93fbe-2e1f-4a4a-b347-9e382427be94/features.json?key=xwxHsc3dQ6fWqVxBQwaq'
      });
      tileLayer.addLayer({
        'id': 'geojson-overlay-fill',
        'type': 'fill',
        'source': 'geojson-overlay',
        'filter': ['==', '$type', 'Polygon'],
        'layout': {},
        'paint': {
          'fill-color': '#fff',
          'fill-opacity': 0.4
        }
      });
      tileLayer.addLayer({
        'id': 'geojson-overlay-line',
        'type': 'line',
        'source': 'geojson-overlay',
        'layout': {},
        'paint': {
          'line-color': 'rgb(68, 138, 255)',
          'line-width': 3
        }
      });
      tileLayer.addLayer({
        'id': 'geojson-overlay-point',
        'type': 'circle',
        'source': 'geojson-overlay',
        'filter': ['==', '$type', 'Point'],
        'layout': {},
        'paint': {
          'circle-color': 'rgb(68, 138, 255)',
          'circle-stroke-color': '#fff',
          'circle-stroke-width': 6,
          'circle-radius': 7
        }
      });
    });