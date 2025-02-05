import 'package:flutter/material.dart';
import 'anemia.dart';
import 'cholesterol.dart';
import 'diabetes.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

const String baseURL = 'georgeclaritacsci410.atwebpages.com';

class Sickness {
  final String _name;

  Sickness(this._name);

  @override
  String toString() {
    return _name;
  }
}

List<Sickness> _sicknesses = [];

void getSicknesses(Function(bool) f) async {
  try {
    _sicknesses.clear();
    final url = Uri.http(baseURL, 'getSicknesses.php');
    final response = await http.get(url);

    if (response.statusCode == 200) {
      final jsonResponse = convert.jsonDecode(response.body);
      for (var row in jsonResponse) {
        Sickness s = Sickness(row['NAME']);
        _sicknesses.add(s);
      }
      f(true);
    }
  } catch (e) {
    f(false);
  }
}

class home1 extends StatefulWidget {
  final String username;

  const home1({Key? key, required this.username}) : super(key: key);

  @override
  State<home1> createState() => _Home1State();
}

class _Home1State extends State<home1> {
  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(
          backgroundColor: Colors.teal,
          title: Padding(
            padding: const EdgeInsets.all(8.0),
            child: RichText(
              text: TextSpan(
                style: const TextStyle(fontSize: 24, color: Colors.black),
                children: <TextSpan>[
                  const TextSpan(
                    text: 'Welcome To ',
                    style: TextStyle(
                      fontWeight: FontWeight.bold,
                      fontSize: 18,
                      color: Colors.white,
                    ),
                  ),
                  TextSpan(
                    text: "Diagnose Me",
                    style: const TextStyle(
                      fontWeight: FontWeight.bold,
                      fontSize: 26,
                      color: Color.fromARGB(255, 255, 196, 59),
                    ),
                  ),
                ],
              ),
            ),
          ),
          centerTitle: true,
          actions: [
            MyDropdownMenuWidget(username: widget.username),
          ],
        ),
        body: SingleChildScrollView(
          padding: const EdgeInsets.all(16.0),
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                'Welcome ${widget.username}!',
                style: const TextStyle(
                  fontSize: 26,
                  fontWeight: FontWeight.bold,
                  color: Colors.teal,
                ),
              ),
              const SizedBox(height: 10),
              const Text(
                'Your personal health companion. This app helps you assess your risk for Diabetes, Cholesterol imbalance, and Anemia based on your symptoms and health data. With just a few simple steps, gain valuable insights into your health status.',
                style: TextStyle(
                  fontSize: 18,
                  height: 1.6,
                  color: Colors.black87,
                ),
              ),
              const SizedBox(height: 30),
              const Text(
                'Key Features',
                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.bold,
                  color: Colors.teal,
                ),
              ),
              const SizedBox(height: 10),
              const Text(
                '• Diabetes Diagnosis: Take a quick and easy test to check for common symptoms such as excessive thirst, frequent urination, and fatigue. Recognize early signs and take necessary steps for treatment.',
                style: TextStyle(
                  fontSize: 18,
                  height: 1.5,
                  color: Colors.black54,
                ),
              ),
              const SizedBox(height: 15),
              const Text(
                '• Cholesterol Check: Evaluate your heart health by tracking cholesterol levels through simple questions. Monitor risks early to prevent complications.',
                style: TextStyle(
                  fontSize: 18,
                  height: 1.5,
                  color: Colors.black54,
                ),
              ),
              const SizedBox(height: 15),
              const Text(
                '• Anemia Detection: Identify possible signs of anemia, like fatigue or pale skin, with a symptom checklist. Early detection ensures effective treatment.',
                style: TextStyle(
                  fontSize: 18,
                  height: 1.5,
                  color: Colors.black54,
                ),
              ),
              const SizedBox(height: 30),
              const Text(
                'How It Works',
                style: TextStyle(
                  fontSize: 24,
                  fontWeight: FontWeight.bold,
                  color: Colors.teal,
                ),
              ),
              const SizedBox(height: 10),
              const Text(
                '• Easy Symptom Check: Select the symptoms you’re experiencing, and the app suggests whether further medical consultation is necessary.',
                style: TextStyle(
                  fontSize: 18,
                  height: 1.5,
                  color: Colors.black54,
                ),
              ),
              const SizedBox(height: 15),
              const Text(
                '• Quick and Simple: Complete symptom checks in minutes, with no need for lab tests.',
                style: TextStyle(
                  fontSize: 18,
                  height: 1.5,
                  color: Colors.black54,
                ),
              ),
              const SizedBox(height: 15),
              const Text(
                '• Guidance: Get personalized suggestions for lifestyle changes and recommendations to see a doctor if necessary.',
                style: TextStyle(
                  fontSize: 18,
                  height: 1.5,
                  color: Colors.black54,
                ),
              ),
            ],
          ),
        ),
      ),
    );
  }
}

class MyDropdownMenuWidget extends StatefulWidget {
  final String username;

  const MyDropdownMenuWidget({super.key, required this.username});

  @override
  State<MyDropdownMenuWidget> createState() => _MyDropdownMenuWidgetState();
}

class _MyDropdownMenuWidgetState extends State<MyDropdownMenuWidget> {
  List<String> pages = [];
  String? selectedValue;

  void getPages() {
    for (int i = 0; i < _sicknesses.length; i++) {
      pages.add(_sicknesses[i].toString());
    }
  }

  @override
  void initState() {
    super.initState();
    getSicknesses((success) {
      if (success) {
        setState(() {
          getPages();
        });
      } else {
        ScaffoldMessenger.of(context).showSnackBar(
          const SnackBar(content: Text('Failed to load data')),
        );
      }
    });
  }

  @override
  Widget build(BuildContext context) {
    List<DropdownMenuItem<String>> dropdownItems = [];
    for (int i = 0; i < pages.length; i++) {
      dropdownItems.add(
        DropdownMenuItem<String>(
          value: pages[i],
          child: Text(pages[i]),
        ),
      );
    }

    return DropdownButton<String>(
      hint: const Text("Select a page"),
      value: selectedValue,
      onChanged: (String? newValue) {
        setState(() {
          selectedValue = newValue;
        });

        if (newValue == "Diabetes") {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => Diabetes(username: widget.username),
            ),
          );
        } else if (newValue == "Cholesterol") {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => cholesterol(
                username: widget.username,
                diabetesResult: '0%',
              ),
            ),
          );
        } else if (newValue == "Anemia") {
          Navigator.push(
            context,
            MaterialPageRoute(
              builder: (context) => anemia(
                username: widget.username,
                diabetesResult: "0%",
                cholesterolResult: "0%",
              ),
            ),
          );
        }
      },
      items: dropdownItems,
    );
  }
}
