<script>
    function showDetails(id) {
        var showDetails = document.getElementById('show_' + id);
        var hideDetails = document.getElementById('hide_' + id);
        var showBlock = document.getElementById('trades_' + id);
        showDetails.style.display = 'none';
        hideDetails.style.display = 'block';
        showBlock.style.display = 'block';
    }

    function hideDetails(id) {
        var showDetails = document.getElementById('show_' + id);
        var hideDetails = document.getElementById('hide_' + id);
        var showBlock = document.getElementById('trades_' + id);
        showDetails.style.display = 'block';
        hideDetails.style.display = 'none';
        showBlock.style.display = 'none';
    }

    imgInp.onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            // alert(URL.createObjectURL(file));
            blah.style.background = "url("+URL.createObjectURL(file)+")";
            blah.style.backgroundRepeat = "no-repeat";
            blah.style.backgroundSize = "cover";
            blah.style.backgroundPosition = "center";
        }
    }

</script>

