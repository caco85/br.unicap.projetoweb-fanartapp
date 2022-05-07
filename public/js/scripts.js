$( document ).ready(function() {
    $('#btnCadastrar').on('click', function () {
        if (this.form.checkValidity()) {
            $(this).attr("disabled", "disabled");
            $(this).val("Submitting...");
            this.form.submit();
        }
    });
});

function checkButton(){
    if (document.getElementById('btnEvaluation').click){
        document.getElementById("toEvaluation").hidden = false;
    }


}
function checkButtonComm(){
    if (document.getElementById('btnComments').click){
        document.getElementById("toComments").hidden = false;
    }
}
function checkInputCB(){
    if (document.getElementById('chancePass').click){
        document.getElementById("chancePassword").hidden = false;
    }
}


$(document).on("click", "#btnModalExcluir", function () {
    var itemID = $(this).attr('data-id');
    $('#modal-delete form').attr('action','delete/'+itemID);

});
