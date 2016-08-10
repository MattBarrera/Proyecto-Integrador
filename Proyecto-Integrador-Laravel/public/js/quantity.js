var timer, delay = 500;
var input = document.getElementById('productoQty').bind('keydown blur change', function(e) {
    // var _this = $(this);
    clearTimeout(timer);
    timer = setTimeout(function() {
        $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.productoQty').on('change', function() {
                var id = $(this).attr('data-id')
                $.ajax({
                  type: "PATCH",
                  url: '/Shop/' + id + '/update',
                  data: {
                    'productoQty': this.value,
                  },
                  success: function(data) {
                    window.location.href = '/Shop';
                  }
                });
            });
    }, delay );
});


// (function(){
//             $.ajaxSetup({
//                 headers: {
//                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//                 }
//             });
//             $('.quantity').on('change', function() {
//                 var id = $(this).attr('data-id')
//                 $.ajax({
//                   type: "PATCH",
//                   url: '/Shop/' + id,
//                   data: {
//                     'quantity': this.value,
//                   },
//                   success: function(data) {
//                     window.location.href = '/cart';
//                   }
//                 });
//             });
//         })();