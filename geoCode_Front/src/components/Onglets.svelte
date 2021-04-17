<script>
    let current = 1

</script>

<style>
    ul {
        list-style: none;
        display: flex;
    }

    li {
        padding: 6px;
        color: #0b7cac;
        cursor: pointer;
    }

    .selected {
        text-decoration: underline;
    }
</style>

<div>
    <ul>
        <li on:click={() => current = 1} class="{current === 1 ? 'selected' : ''}">Gestion des données</li>
        <li  on:click={() => current = 2} class="{current === 2 ? 'selected' : ''}">Clés API</li>
    </ul>
</div>