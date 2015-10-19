//動作事件
var sysFrameItem = function ( actionClass, actionType ) {
    this.aClass = actionClass;
    if(typeof actionType == 'undefined'){
        this.actionType = '';
    }
};

sysFrameItem.prototype = {
    aClass: '',
    actionType: '',
    showAction: function () {
        $("."+aClass).show();
    },
    hideAction: function () {
        $("."+aClass).hide();
    },
    getInputAction: function(){
        var ItemData = {};
        $("."+aClass).each(function(i,v){
           ItemData.i = v;
        });
        return ItemData;
    }
    getItemIDAction: function(){
        if(actionType){
            $("."+aClass).prop("id").replace(actionType+'Act');
        }else{
            console.log('actionType is not set');
        }
    }
};


//$(this),insert/modify/delete/finish, tableID/DivID, ctrlPage
function sysFrameBtn(actionObject, actionType, listID, actionUrl){
    var dataObject, appendAction=false;
    
    switch(actionType){
        case "insert":
            appendAction = true;
        break;
        case "modify":
            
        break;
        case "delete":
        break;
        case "finish":
            
        break;
    }
    optionAction(actionUrl, listID, dataObject, appendAction);
}

function optionAction(actionUrl, listID, dataObject, appendAction){
    if(actionUrl != ''){
        $.ajax({
            url: actionUrl,
            type: "POST",
            data: dataObject,
            success: function(rs){
               if(appendAction){
                   rs+$("#"+listID)
               }
               console.log(rs);
            },
            error:function(xhr, ajaxOptions, thrownError){
               alert('Error');
            }
        });
    }else{
        console.log('actionUrl is not set');
    }
}