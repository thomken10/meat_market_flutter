import 'dart:convert';

import 'package:p4_landingpage/components/carouseladvertising.dart';
import 'package:p4_landingpage/components/carouselloading.dart';
import 'package:p4_landingpage/components/headerproduk.dart';
import 'package:p4_landingpage/components/itemproduk.dart';
import 'package:p4_landingpage/constanta.dart';
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:http/http.dart' as http;

class HomeScreen extends StatefulWidget {
  @override
  _HomeScreenState createState() => _HomeScreenState();
}

class _HomeScreenState extends State<HomeScreen> {
  @override
  void initState() {
    super.initState();
  }

  getData() async {
    http.Response res = await http.post(baseUrl + sliderAtas, body: bioAccount);
    return json.decode(res.body);
  }

  getProduk() async {
    http.Response res =
        await http.post(baseUrl + contentProduct, body: bioAccount);
    return json.decode(res.body);
  }

  @override
  Widget build(BuildContext context) {
    Size size = MediaQuery.of(context).size;
    return Scaffold(
      backgroundColor: Color(0xfff7f7f7),
      appBar: AppBar(
          title: Text(
        "MeatMarket.id",
        style: GoogleFonts.lato(),
      )),
      body: SingleChildScrollView(
        child: ListView(
          physics: NeverScrollableScrollPhysics(),
          shrinkWrap: true,
          children: [
            FutureBuilder(
                future: getData(),
                builder: (context, snapshot) {
                  if (snapshot.hasError) throw (snapshot.error);
                  if (snapshot.hasData) {
                    List listAds = snapshot.data['data'];
                    return AdvertisingSlider(list: listAds);
                  } else {
                    return CarouselLoading();
                  }
                }),
            HeaderProduk(),
            FutureBuilder(
              future: getProduk(),
              builder: (context, snapshot) {
                if (snapshot.hasError) throw (snapshot.error);
                if (snapshot.hasData) {
                  List item = snapshot.data['data'];
                  return Padding(
                    padding: EdgeInsets.symmetric(horizontal: 12),
                    child: GridView.count(
                        childAspectRatio: ((size.width / 2) / 290),
                        scrollDirection: Axis.vertical,
                        crossAxisCount: 2,
                        physics: NeverScrollableScrollPhysics(),
                        shrinkWrap: true,
                        children: item.map((e) {
                          return ItemProduk(
                              size: size,
                              harga: e['product_price'],
                              tempatPengirim: e['product_from'],
                              ontap: () {},
                              imgUrl: e['product_image'],
                              title: e['product_name']);
                        }).toList()),
                  );
                } else {
                  return Center(child: CircularProgressIndicator());
                }
              },
            ),
            SizedBox(
              height: 20,
            )
          ],
        ),
      ),
    );
  }
}
