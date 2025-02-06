$(function() {
    "use strict";
    var wanumber = $("#wanumber").val();
    var waheader = $("#waheader").val();
    var wapopup = $("#wapopup").val();
    var wabtnimg = $("#wabtnimg").val();
    $('#WAButton').floatingWhatsApp({
        phone: wanumber, //WhatsApp Business phone number
        headerTitle: waheader, //Popup Title
        headerColor: 'crimson',
        backgroundColor: 'crimson',
        popupMessage: wapopup, //Popup Message
        showPopup: true, //Enables popup display
        buttonImage: '<img src="'+wabtnimg+'/images/whatsapp.png" />', //Button Image
        position: "left" //Position: left | right
        
     });
     $("#WAButton").addClass("wa-right");
 });