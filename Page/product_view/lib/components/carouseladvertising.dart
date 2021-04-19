import 'package:cached_network_image/cached_network_image.dart';
import 'package:carousel_slider/carousel_slider.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';

class AdvertisingSlider extends StatelessWidget {
  AdvertisingSlider({@required this.list});
  final List list;

  @override
  Widget build(BuildContext context) {
    return CarouselSlider(
      options: CarouselOptions(
          autoPlay: true,
          enlargeCenterPage: true,
          height: MediaQuery.of(context).size.height / 4,
          aspectRatio: 16 / 9,
          enableInfiniteScroll: true,
          autoPlayCurve: Curves.fastOutSlowIn,
          viewportFraction: 0.7),
      items: list.map((e) {
        return Builder(builder: (BuildContext context) {
          return Container(
              margin: EdgeInsets.only(top: 10),
              width: MediaQuery.of(context).size.width,
              decoration: BoxDecoration(
                  borderRadius: BorderRadius.circular(10),
                  image: DecorationImage(
                      fit: BoxFit.cover,
                      image: CachedNetworkImageProvider(e['carousel_image']))),
              child: Center(
                child: Padding(
                  padding: const EdgeInsets.all(10),
                  child: Text(
                    e['carousel_title'],
                    style: GoogleFonts.lato(
                        fontWeight: FontWeight.bold,
                        color: Colors.white,
                        fontSize: 18),
                    textAlign: TextAlign.center,
                  ),
                ),
              ));
        });
      }).toList(),
    );
  }
}
