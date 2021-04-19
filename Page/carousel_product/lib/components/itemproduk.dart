import 'package:cached_network_image/cached_network_image.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class ItemProduk extends StatelessWidget {
  const ItemProduk(
      {Key key,
      @required this.size,
      @required this.imgUrl,
      @required this.ontap,
      @required this.tempatPengirim,
      @required this.harga,
      @required this.title})
      : super(key: key);

  final Size size;

  final String title;
  final String harga;
  final String imgUrl;
  final String tempatPengirim;
  final Function ontap;

  @override
  Widget build(BuildContext context) {
    return Padding(
      padding: const EdgeInsets.all(5),
      child: Material(
        color: Colors.white,
        borderRadius: BorderRadius.circular(10),
        elevation: 0.2,
        child: InkWell(
          borderRadius: BorderRadius.circular(10),
          onTap: ontap,
          child: Container(
            decoration: BoxDecoration(borderRadius: BorderRadius.circular(10)),
            child: Column(
              mainAxisAlignment: MainAxisAlignment.start,
              children: [
                ClipRRect(
                  //gambar
                  borderRadius: BorderRadius.only(
                      topLeft: Radius.circular(10),
                      topRight: Radius.circular(10)),
                  child: CachedNetworkImage(
                    imageUrl: imgUrl,
                    height: 150,
                    width: size.width,
                    fit: BoxFit.cover,
                    errorWidget: (context, url, error) => Icon(Icons.error),
                  ),
                ),
                Align(
                  //judul
                  alignment: Alignment.centerLeft,
                  child: Padding(
                      padding: EdgeInsets.all(7),
                      child: Text(
                        title,
                        style: GoogleFonts.lato(fontWeight: FontWeight.bold),
                        maxLines: 3,
                        overflow: TextOverflow.ellipsis,
                      )),
                ),
                Align(
                  //harga
                  alignment: Alignment.centerLeft,
                  child: Padding(
                    padding: EdgeInsets.only(left: 7, right: 7),
                    child: Text(
                      "Rp. " + harga,
                      maxLines: 1,
                      overflow: TextOverflow.ellipsis,
                      style: GoogleFonts.lato(
                          color: Colors.red, fontWeight: FontWeight.bold),
                    ),
                  ),
                ),
                Align(
                  // penerbit
                  alignment: Alignment.centerLeft,
                  child: Padding(
                      padding: EdgeInsets.only(left: 7, right: 7, top: 2),
                      child: Text(tempatPengirim,
                          maxLines: 2,
                          overflow: TextOverflow.ellipsis,
                          style: GoogleFonts.lato(
                              fontSize: 13,
                              color: Colors.grey[600],
                              fontWeight: FontWeight.normal))),
                )
              ],
            ),
          ),
        ),
      ),
    );
  }
}
