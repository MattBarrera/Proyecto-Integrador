window.addEventListener("load", function () {
    var IDLE_TIMEOUT = 120; //seconds
    var _idleSecondsCounter = 0;
    document.onclick = function() {
        _idleSecondsCounter = 0;
    };
    document.onmousemove = function() {
        _idleSecondsCounter = 0;
    };
    document.onkeypress = function() {
        _idleSecondsCounter = 0;
    };
    window.setInterval(CheckIdleTime, 1000);

    function CheckIdleTime() {
        _idleSecondsCounter++;
        // var oPanel = document.getElementById("SecondsUntilExpire");
        // if (oPanel)
        //     oPanel.innerHTML = (IDLE_TIMEOUT - _idleSecondsCounter) + "";
        if (_idleSecondsCounter >= IDLE_TIMEOUT) {
            alert("todavia estas ahi!?");
            _idleSecondsCounter = 0;
        }
    }
});