package com.example.cart;

public class Cart {
    private String id_barang;
    private String img_url;
    private String varian;
    private String qty;
    private String harga;
    private String total;

    public Cart(String id_barang, String img_url, String varian, String qty, String harga, String total) {
        this.id_barang = id_barang;
        this.img_url = img_url;
        this.varian = varian;
        this.qty = qty;
        this.harga = harga;
        this.total = total;
    }

    public String getId_barang() {
        return id_barang;
    }

    public String getQty() {
        return qty;
    }

    public String getImg_url() {
        return img_url;
    }

    public Cart setImg_url(String img_url) {
        this.img_url = img_url;
        return this;
    }

    public String getTotal() {
        return total;
    }

    public Cart setId_barang(String id_barang) {
        this.id_barang = id_barang;
        return this;
    }

    public Cart setQty(String qty) {
        this.qty = qty;
        return this;
    }

    public Cart setTotal(String total) {
        this.total = total;
        return this;
    }

    public String getVarian() {
        return varian;
    }

    public Cart setVarian(String varian) {
        this.varian = varian;
        return this;
    }

    public String getHarga() {
        return harga;
    }

    public Cart setHarga(String harga) {
        this.harga = harga;
        return this;
    }
}
