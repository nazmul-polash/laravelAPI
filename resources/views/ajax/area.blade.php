<label for="">City </label>
<select name="area_name" id="" class="form-control">
   <option value="">Select City</option>
   @foreach ($areas as $area)
      <option value="{{ $area->area_id }}">{{ $area->area_name }}</option>
   @endforeach

</select>
