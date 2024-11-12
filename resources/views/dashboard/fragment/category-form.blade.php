@csrf()

<label for="">Title</label>
<input class='form-control' type="text" name="title" value="{{old('title', $category->title)}}">

<label for="">Slug</label>
<input class='form-control' type="text" name="slug" value="{{old('slug', $category->slug)}}">

<button class="btn btn-success" type="submit">Send</button>