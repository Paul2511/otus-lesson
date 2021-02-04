<tr>
    <th scope="row">{{$article->id}}</th>
    <td>{{$article->name}}</td>
    <td>{{$article->created_at}}</td>
    <td class="text-center">{{$article->sort}}</td>
    <td>{{$article->description}}</td>
    <td>
        @include('admin.articles.blocks.form.control',['id'=>$article->id])
    </td>

</tr>
