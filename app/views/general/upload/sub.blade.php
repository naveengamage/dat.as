
<select class="mediuminput" name="sub_cat">
<option value="0">Please Select Sub Category</option>
@foreach($cats as $cat)
		<option value="{{$cat->id}}">{{$cat->name}}</option>
@endforeach
</select>