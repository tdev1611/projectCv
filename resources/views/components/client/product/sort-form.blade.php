<form method="get" action="{{ route('client.product.sort') }}">
    <select name="sort">
        <option value="">Sắp xếp</option>
        <option value="name_asc">Từ A-Z</option>
        <option value="name_desc">Từ Z-A</option>
        <option value="price_desc">Giá cao xuống thấp</option>
        <option value="price_asc">Giá thấp lên cao</option>
    </select>
    <button type="submit">Lọc</button>
</form>
