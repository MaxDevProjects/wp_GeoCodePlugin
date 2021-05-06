<script>
    export let datas = [];

    let getDataMapList = (async () => {

    await fetch('../wp-content/plugins/geoCode/model/GetAllData.php')
        .then(data => data.json())
        .then(data => {
            datas = data
        })
        .catch((error) => {
            console.error(error)
        })
    return datas
    })()
</script>

<style>
div {
    position: absolute;
    top: 0;
    right: 0;
    z-index: 9999999;
    background: white;
    height: 100%;
}

ul > li{
    text-align: right;
    padding: 4px 6px;
    display: grid;
    grid-template-columns: repeat(5, 1fr);
}

ul > li:hover {
    background-color: #f1f1f1;
}

.fa {
    cursor: pointer;
    padding: 4px;
}

.fa-pencil {
    color: #0b7cac;
}
.fa-trash {
    color: #ac0b39;
}
</style>

<svelte:head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw==" crossorigin="anonymous" />
</svelte:head>
{#await getDataMapList}
    <i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
    <span class="sr-only">Loading...</span>
    {:then datasMap}
    <ul>
    {#each datasMap as dm}
        <li>
            <span>{dm.nom}</span>
            <span>{dm.adresse}</span>
            <span>{dm.codepostal}</span>
            <span>{dm.ville}</span>
            <span>
                <i class="fa fa-pencil fa-2" aria-hidden="true"></i>
                <i class="fa fa-trash fa-2" aria-hidden="true"></i>
            </span>
    {/each}
    </ul>
{:catch error}
    <p>{error}</p>
{/await}
