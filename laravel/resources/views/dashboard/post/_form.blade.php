@csrf
<label for="">Título</label>
<input type="text" name="title" value="{{ old("title",$post->title) }}">
<br>
<label for="">Slug</label>
<input type="text" name="slug" value="{{ old("slug",$post->slug) }}">
<br>
<label for="">Categoría</label>
<select name="category_id">
 <option value=""></option>
 @foreach ($categories as $title => $id)
 <option {{ old("category_id","$post->category_id") == $id ? "selected" : "" }} value="{{ $id
}}">{{ $title }}</option>
 @endforeach
</select>
<br>
<label for="">Posteado</label>
<select name="posted">
 <option {{ old("posted",$post->posted) == "not" ? "selected" : "" }} value="not">No</option>
 <option {{ old("posted",$post->posted) == "yes" ? "selected" : "" }} value="yes">Si</option>
</select>
<br>
<label for="">Contenido</label>
<textarea name="content"> {{ old("content",$post->content) }}</textarea>
<br>
<label for="">Descripción</label>
<textarea name="description">{{ old("description",$post->description) }}</textarea>
<br>
@if (isset($task) && $task == 'edit')
 <label for="">Image</label>
 <input type="file" name="image">
@endif
<br>
<button type="submit">Enviar</button>