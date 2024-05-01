<?php
function printErrorModal($textoError){ 
    ?>
<script>
    document.getElementById("modal-container").classlist.remove("hidden");
    document.getElementById("printErrorModal").innerText = '<?php echo 'Hola nuria (^^ゞ' ?>' ;
</script>
<?php
 }
?>

<style>
    #modal-container {
        background-color: rgba(0, 0, 0, 0.69);
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        z-index: +1;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    #modal-container.hidden {
        display: none;
        visibility: none;
    }
    #modal-container .modal {
        max-width: 960px;
        width: 100%;
        max-height: 60%;
        background-color: #080808;
        border-radius: 4px;
        color: #ffffffda;
        border: 6px solid #fff;
    }
    #modal-container .modal p {
        padding: 0;
        margin: 0;
    }
</style>

<div id="modal-container" class="hidden">
    <div class="modal">
        <p id="printErrorModal">Hola</p>
    </div>
</div>

<script>
    document.addEventListener("keyup", e => {
        // if we press the ESC
        if (e.key == "Escape" && document.querySelector("#modal-container")) {
            document.getElementById("modal-container").classList.add("hidden");
        }
    });

    document.addEventListener("click", e => {
        if (e.target == document.querySelector("#modal-container")) {
            document.querySelector("#modal-container").classList.add("hidden");
        }
    });
</script>