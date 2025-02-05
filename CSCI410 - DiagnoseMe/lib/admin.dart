import 'package:flutter/material.dart';
import 'dart:convert';
import 'package:http/http.dart' as http;

const String baseURL = 'georgeclaritacsci410.atwebpages.com';

class Test {
  final int id;
  final String patientName;
  final String feedback;
  final List<Map<String, dynamic>> results;

  Test({
    required this.id,
    required this.patientName,
    required this.feedback,
    required this.results,
  });

  factory Test.fromJson(Map<String, dynamic> json) {
    return Test(
      id: int.parse(json['test_id'].toString()),
      patientName: json['patient_name'],
      feedback: json['feedback'],
      results: List<Map<String, dynamic>>.from(json['results']),
    );
  }
}

class admin extends StatefulWidget {
  const admin({Key? key}) : super(key: key);

  @override
  State<admin> createState() => _adminState();
}

class _adminState extends State<admin> {
  late Future<List<Test>> tests;

  @override
  void initState() {
    super.initState();
    tests = fetchTests();
  }

  Future<List<Test>> fetchTests() async {
    final url = Uri.http(baseURL, 'getResults.php');
    final response = await http.get(url);

    if (response.statusCode == 200) {
      final List<dynamic> jsonData = json.decode(response.body);
      return jsonData.map((data) => Test.fromJson(data)).toList();
    } else {
      throw Exception("Failed to load tests");
    }
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(
          title: const Text(
            "Admin",
            style: TextStyle(
              fontWeight: FontWeight.bold,
              fontSize: 32,
              color: Colors.white,
            ),
          ),
          centerTitle: true,
          backgroundColor: Colors.teal,
          leading: IconButton(
            icon: const Icon(Icons.arrow_back, color: Colors.white),
            onPressed: () {
              Navigator.pop(context);
            },
          ),
        ),
        body: FutureBuilder<List<Test>>(
          future: tests,
          builder: (context, snapshot) {
            if (snapshot.connectionState == ConnectionState.waiting) {
              return const Center(child: CircularProgressIndicator());
            } else if (snapshot.hasError) {
              return Center(child: Text("Error: ${snapshot.error}"));
            } else if (!snapshot.hasData || snapshot.data!.isEmpty) {
              return const Center(child: Text("No tests found."));
            }

            final testList = snapshot.data!;
            return ListView.builder(
              padding: const EdgeInsets.all(10),
              itemCount: testList.length,
              itemBuilder: (context, index) {
                final test = testList[index];
                return Column(
                  crossAxisAlignment: CrossAxisAlignment.start,
                  children: [
                    Text(
                      "Test ID: ${test.id}",
                      style: const TextStyle(
                        fontSize: 20,
                        fontWeight: FontWeight.bold,
                        color: Colors.teal,
                      ),
                    ),
                    const SizedBox(height: 10),
                    Text(
                      "Patient: ${test.patientName}",
                      style: const TextStyle(fontSize: 15),
                    ),
                    const SizedBox(height: 10),
                    Text(
                      "Feedback: ${test.feedback}",
                      style: const TextStyle(fontSize: 15),
                    ),
                    const SizedBox(height: 10),
                    const Text(
                      "Results:",
                      style:
                          TextStyle(fontSize: 15, fontWeight: FontWeight.bold),
                    ),
                    const SizedBox(height: 5),
                    ...test.results.map((result) {
                      return Text(
                        "${result['sickness_name']}: ${result['sickness_result']}",
                        style: const TextStyle(fontSize: 14),
                      );
                    }).toList(),
                    const Divider(),
                  ],
                );
              },
            );
          },
        ),
      ),
    );
  }
}
