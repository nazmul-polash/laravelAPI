<label for="">City </label>
<select name="city_name" id="enableCity" class="form-control" onchange=getarea(this.value)>
   <option value="">Select City</option>
   @foreach ($cities as $city)
      <option value="{{ $city->city_id }}">{{ $city->city_name }}</option>
   @endforeach

</select>

<script>
   function getarea(e){
      $.ajax({
            type: 'POST',
            url: '{{ route('enable.area') }}',
            data: {
               'city_id': e,
               '_token': '{{ csrf_token() }}',
            },
            success:function(response){
               if(response.success){
                  $('#area').html(response.html);
               }else{
                  console.log('error expect');
               }
            }
         })
   }
</script>

