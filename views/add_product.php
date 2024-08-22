<form id="add_products" method="POST" action="/" enctype="multipart/form-data">
    <input type="text" name='title' placeholder='title'>
    <input type="text" name='description' placeholder='description'>
    <label>
        Choose images
        <input type="file" name="images[]" accept=".jpg,.png,.jpeg,.webp" multiple>
    </label>
    <input type="text" name='price' placeholder='price'>
    <input type="text" name='category' placeholder='category'>
    <input type="hidden" action='class' value="Product">
    <input type="hidden" action='method' value="create">
    <input type="submit">
</form>

