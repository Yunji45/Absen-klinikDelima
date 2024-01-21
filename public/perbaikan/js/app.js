//main class
function App() {
    var _self   = this;

    this.oldPosition = 0;

    //views objects
    this.views  = {
        countdown:  $("#countdown"),
        clouds:     $("#clouds"),
        city:       $("#city"),
        city2:      $("#city2"),
        car:        $("#car"),
        form:       $("#form-newsletter")
    };

    //init function
    this.init = function() {

        //date to countdown
        date = new Date(2019, 11, 25),

        //init countdown
        this.views.countdown.countdown({
            timestamp	: date
        });


        this.views.form.validate();
        this.views.form.submit(this.subscribeSubmit);

        //animate background
        this.animate();
    };

    this.animate = function() {
        //offset for clouds and cities
        var offset = 0;
        //offset for car
        var carOffset = parseInt(this.views.car.css('left'));

        //move clouds and cities
        window.setInterval(function(){
            _self.views.clouds.attr("style", "background-position: " + offset + "px 0px");
            _self.views.city.attr("style", "background-position: " + offset * 0.5 + "px 0px");
            _self.views.city2.attr("style", "background-position: " + offset * -1 + "px 0px");

            offset -= 1;
        }, 30);


        //first car animate
        var tmp = ($(document).width() - $(".center").width()) / 2;
        tmp += 400;
        _self.views.car.animate({
            left:  tmp  * -1
        }, 8000);

        //loop for car animate
        window.setInterval(function() {
            _self.views.car.removeAttr('style');
            _self.views.car.css('left', $(".center").width() + tmp);

            _self.views.car.animate({
                left:  tmp  * -1
            }, 8000);
        }, 8100);

    };


     //subscribe click
    this.subscribeSubmit = function() {

        //if form is valid
        if($(this).valid()) {
            //save email in newsletter file
            $.post("Your PHP file link here", {
                email:   $("input#email").val()
            }, function(data) {
                 //if everything is ok, close dialog and show message
                 if(data == "1") {
                     alert("Email saved. Thank you");
                 } else { //else show error
                    alert("Something goes wrong. Please try one more time.");
                 }
             });
        }

        return false;
    };
}

$(document).ready(function(){
   //create and init app class
   window.app = new App();
   window.app.init();
});
