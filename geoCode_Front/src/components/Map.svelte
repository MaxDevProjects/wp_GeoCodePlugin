<script>
    import L from "leaflet";
    import "leaflet/dist/leaflet.css"
    import {onMount} from "svelte";
    import List from "./List.svelte";

    let geoData = []
    onMount(async () => {
        const resp = await fetch('../wp-content/plugins/geoCode/model/GetAllData.php')
        geoData = await resp.json()
        // Creation de la map dans le Map container #leafletMap
        const leafletMap = L.map('leafletMap').setView([47.742976, 1.5826943999999998], 5);
        //information relative à la création de la map avec appel API de mapBox
        L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoiY2xvd2VyIiwiYSI6ImNrbmF2anliYTB4b24ycHBkMXQ3amVyM3gifQ.IkTSxTiHW8UkWQb-VRDzSQ'
        }).addTo(leafletMap);
        // Création de marker
        geoData.forEach((data) => {
            L
                .marker([data.latitude, data.longitude]).addTo(leafletMap)
                .bindPopup(`<b>${data.nom}</b><br>${data.numero} ${data.type} ${data.adresse}<br>${data.codepostal} ${data.ville}`).openPopup();
        })
    })
</script>

<style>
#leafletMap {
    margin: auto;
    width: 80%;
    height: 100%;
    position: relative;
}
</style>


<List datas="{geoData}"/>
<div id="leafletMap">
</div>
