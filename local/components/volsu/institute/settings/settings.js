/*function validate(arParams)
{
    this.arParams = arParams;
    var obInput = document.createElement('INPUT');
    this.arParams.oCont.appendChild(obInput);
    obInput.setAttribute('type', 'text');
    let regex = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
}*/

function OnTextAreaConstruct(arParams) {
    var iInputID = arParams.oInput.id;
    var iTextAreaID = iInputID + '_ta';
 
    var obLabel = arParams.oCont.appendChild(BX.create('textarea', {
       props : {
          'cols' : 40,
          'rows' : 5,
          'id' : iTextAreaID
       },
       html: arParams.oInput.value
    }));
 
    $("#"+iTextAreaID).on('keyup', function() {
       $("#"+iInputID).val($(this).val());
    });
 }