<form action="/auth/reset-password/request">
    <input type="text" name="id" value="{{$id}}"><br><br>
    <input type="text" name="hex" value="{{$hex}}"><br><br>

    <input type="password" name="password"> <br><br>
    <input type="password" name="confirm"><br><br>
    <button>Save</button>
</form>