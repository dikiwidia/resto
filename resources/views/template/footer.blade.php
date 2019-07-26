    <script src="{{asset('assets/resto/vendor/jQuery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/resto/vendor/font-awesome/js/all.min.js')}}"></script>
    <script src="{{asset('assets/resto/js/bootstrap.min.js')}}"></script>

    <script type="text/javascript">
    $(document).ready(function() {
      	var max_fields      = 100; //maximum input boxes allowed
      	var wrapper   		  = $(".wrapper"); //Fields wrapper
      	var add_button      = $(".addOrder"); //Add button ID

      	var x = 1; //initlal text box count
      	$(add_button).click(function(e){ //on add input button click
        		e.preventDefault();
        		if(x < max_fields){ //max input box allowed
          			x++;
                //$(wrapper).find('.removeOrder').attr('id', 'id' + x);
                var klon = $(wrapper).clone();
                klon.find("input.zero-input").val(0);
                klon.find("input[name='qty[]']").val(0);
                klon.find(".pricetag").val(0);
                klon.find(".hidden-input").attr("id",'hide-id'+ x);
                klon.find("button.min").attr('id', 'btnmin-id' + x);
                klon.find("button.plus").attr('id', 'btnplus-id' + x);
                klon.find("input[name='qty[]']").attr('id', 'id' + x);
                klon.find(".removeOrder, .zero-input").attr('id', 'id' + x);
                klon.appendTo('.clone:last').attr('id', 'id' + x);
        		}
      	});

      	// $('.clone').on("click",".remove_field", function(e){ //user click on remove text
      	// 	e.preventDefault(); $(this).parent('div.input_fields_wrap').remove(); x--;
      	// });
        $('.wrap').on("click",".removeOrder", function(e){
            e.preventDefault();
            if($('.wrapper').length > 1){
                $('.wrap').find('div#'+this.id).remove();
                updatePrice(event);
            }
      	});
        $('.wrap').on("change","select", function(){
            var getID = $(this).closest('.wrapper').attr('id');
            $('div#' + getID).find("input[name='qty[]']").attr('id', 'qty-' + getID).val(0);
            $('div#' + getID).find("input#hide-"+ getID).val(0);
            $('div#' + getID).find('.pricetag').val(0);
            //alert(a);
            var menu_id = $('option:selected', this).val();
            //alert(menu_id);
            $.ajax({
                type: "POST",
                url: "{{ route('dashboard.ajax') }}",
                data: {
                    "_token" : "{{ csrf_token() }}",
                    "menu_id" : menu_id
                },
                success: function(response){
                    $('.wrap').find('input#' + getID).val(0);
                    $('div#' + getID).find('.pricetag').val(response);
                    $('.wrap').find('input#hide-' + getID).val(response);
                }
            });
            updatePrice(event);
      	});
        // This button will increment the value
        $('.wrap').on("click",".plus",function(e) {
            // Stop acting like a button
            e.preventDefault();
            var classVal = this.id.split('-');
            // Get its current value
            var currentVal = parseInt($('input#qty-'+classVal[1]).val());
            // // If is not undefined
            if (!isNaN(currentVal)) {
                // Increment
                $('input#qty-'+classVal[1]).val(currentVal + 1);
                var newVal = parseInt($('input#qty-'+classVal[1]).val());
                var currentPrice = $("input#hide-"+classVal[1]).val();
                $('input#'+classVal[1]).val(newVal * currentPrice);
            } else {
                // Otherwise put a 0 there
                $('input#qty-'+classVal[1]).val(0);
                var newVal = parseInt($('input#qty-'+classVal[1]).val());
            }
            updatePrice(event);
        });
        // This button will decrement the value till 0
        $('.wrap').on("click",".min",function(e) {
            // Stop acting like a button
            e.preventDefault();
            var classVal = this.id.split('-');
            // Get the field name
            var currentVal = parseInt($('input#qty-'+classVal[1]).val());
            // If it isn't undefined or its greater than 0
            if (!isNaN(currentVal) && currentVal > 0) {
                // Decrement one
                $('input#qty-'+classVal[1]).val(currentVal - 1);
                var newVal = parseInt($('input#qty-'+classVal[1]).val());
                var currentPrice = $("input#hide-"+classVal[1]).val();
                $('input#'+classVal[1]).val(newVal * currentPrice);
                updatePrice(event);
            } else {
                // Otherwise put a 0 there
                $('input#qty-'+classVal[1]).val(0);
            }
        });
        function updatePrice(e) {
            e.preventDefault();
            var sum = 0;
            $('.clone').find('.zero-input').each(function(){
                sum += parseInt($(this).val());  // Or this.innerHTML, this.innerText
            });

            $('.price').val(sum);
            // here, you have your sum
        }
    });
    // $(function() {
    //     $('.select').change(function(){
    //         alert('other value');
    //     });
    // });
    </script>
</body>
</html>
