<script>
    import axios from "axios";
    import Notification from "./Notification.svelte";

    let name = "", address = "", cp = "", city = "", country = "", lon = "", lat = ""
    let isRequired = false
    let notifySuccess = false
    let getFormData = async () => {
        let dataTest = {
            name,
            address,
            cp,
            city,
            country,
            lon,
            lat,
        }
        const insertDataUrl = '../wp-content/plugins/geoCode/model/InsertGeoData.php'
        if ((name && address && cp && city && lat && lon) !== "") {
            await axios.post(insertDataUrl, null, {params: dataTest})
                .then((response) => {
                    if (response.statusText === "OK") {
                        notifySuccess = true
                        return response;
                    } else {
                        return response.statusText
                    }
                })
                .catch((error) => {
                    console.log(error)
                })
        } else {
            isRequired = true
        }
        if (notifySuccess) {
            name = ""
            address = ""
            cp = ""
            city = ""
            country = ""
            lon = ""
            lat = ""
            isRequired = false
        }
    }

    let getApiAdressGeoCode = (() => {
        if (address && cp && city) {
            axios
                .get("https://api-adresse.data.gouv.fr/search/", {
                    params: {
                        q: `${address} ${cp} ${city}`
                    }
                }).then(res => {
                let data = res.data
                let geometry = data.features[0].geometry
                lat = geometry.coordinates[1]
                lon = geometry.coordinates[0]
                console.log(data)
                })
        } else {
            console.log("il faut saisir toutes les informations requises")
        }
    })
</script>

<form method="post">
    <div class="grid">
        {#if notifySuccess}
            <Notification/>
        {/if}
        <input class={isRequired ? 'required' : ''} type="text" name="name" id="name" bind:value={name} placeholder="Nom">
        <input class={isRequired ? 'required' : ''}  type="text" name="address" id="adresse" bind:value={address}  placeholder="Adresse">
        <div class="grid c-2">
            <input class={isRequired ? 'required' : ''}  type="text" name="cp" id="cp" bind:value={cp}  placeholder="Code postal">
            <input class={isRequired ? 'required' : ''}  type="text" name="city" id="ville" bind:value={city}  placeholder="Ville">
        </div>
        <input class={isRequired ? 'required' : ''}  type="text" name="pays" id="pays" bind:value={country}  placeholder="Pays">
        <input on:click={getApiAdressGeoCode} class="button button-default" type="button" name="search" value="Rechercher Geocode Lon.Lat">
        <div class="grid c-2">
            <input class={isRequired ? 'required' : ''} type="text" name="lat" id="lat" bind:value={lat}  placeholder="Latitude">
            <input class={isRequired ? 'required' : ''} type="text" name="lon" id="lon" bind:value={lon}  placeholder="Longitude">
        </div>
        <button on:click={getFormData} class="button button-primary" type="button" value="Envoyer" name="submit">Envoyer</button>
    </div>
</form>

<style>
    .grid {
        display: grid;
        gap: 16px;
        overflow: hidden;
    }

    .grid.c-2 {
        grid-template-columns: auto auto;
        position: relative;
    }

    .grid.c-20-15-a {
        grid-template-columns: 20% 15% auto;
    }

    select.required,input.required {
        border-color: red;
    }

    @media screen and (max-width: 768px){
        .grid.c-2 {
             grid-template-columns: auto;
        }
    }
</style>