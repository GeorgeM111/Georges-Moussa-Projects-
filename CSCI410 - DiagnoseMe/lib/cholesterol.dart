import 'package:flutter/material.dart';
import 'anemia.dart';
import 'package:http/http.dart' as http;
import 'dart:convert' as convert;

const String baseURL = 'georgeclaritacsci410.atwebpages.com';

class Symptom {
  final String name;

  Symptom(this.name);

  @override
  String toString() {
    return name;
  }
}

class cholesterol extends StatefulWidget {
  final String username;
  final String diabetesResult;

  const cholesterol({
    Key? key,
    required this.username,
    required this.diabetesResult,
  }) : super(key: key);

  @override
  State<cholesterol> createState() => _CholesterolState();
}

class _CholesterolState extends State<cholesterol> {
  List<Symptom> symptoms = [];
  Map<int, bool> checkboxStates = {};
  bool isLoading = true;
  bool hasError = false;
  int count = 0;

  @override
  void initState() {
    super.initState();
    fetchSymptoms();
  }

  Future<void> fetchSymptoms() async {
    try {
      setState(() {
        isLoading = true;
        hasError = false;
      });

      final url = Uri.http(baseURL, 'getSymptoms.php', {'sid': '2'});
      final response = await http.get(url).timeout(const Duration(seconds: 5));

      if (response.statusCode == 200) {
        final List<dynamic> jsonResponse = convert.jsonDecode(response.body);
        setState(() {
          symptoms = jsonResponse.map((data) => Symptom(data['NAME'])).toList();
          for (int i = 0; i < symptoms.length; i++) {
            checkboxStates[i] = false;
          }
          isLoading = false;
        });
      } else {
        setState(() {
          hasError = true;
          isLoading = false;
        });
      }
    } catch (e) {
      setState(() {
        hasError = true;
        isLoading = false;
      });
    }
  }

  String calculateResult(int selectedCount) {
    if (selectedCount == 0) {
      return "0%";
    }
    return "${(selectedCount * (100 / symptoms.length)).toStringAsFixed(2)}%";
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(
          backgroundColor: Colors.teal,
          title: Row(
            mainAxisAlignment: MainAxisAlignment.spaceBetween,
            children: [
              ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.white,
                  shape: const CircleBorder(),
                ),
                onPressed: () {
                  Navigator.of(context).pop();
                },
                child: const Icon(Icons.navigate_before, color: Colors.teal),
              ),
              const Text(
                'Cholesterol Diagnosis',
                style: TextStyle(
                  fontWeight: FontWeight.bold,
                  fontSize: 20,
                  color: Colors.white,
                ),
              ),
              ElevatedButton(
                style: ElevatedButton.styleFrom(
                  backgroundColor: Colors.white,
                  shape: const CircleBorder(),
                ),
                onPressed: () {
                  String cholesterolResult = calculateResult(count);
                  Navigator.of(context).push(
                    MaterialPageRoute(
                      builder: (context) => anemia(
                        username: widget.username,
                        diabetesResult: widget.diabetesResult,
                        cholesterolResult: cholesterolResult,
                      ),
                    ),
                  );
                },
                child: const Icon(Icons.navigate_next, color: Colors.teal),
              ),
            ],
          ),
          centerTitle: true,
        ),
        body: isLoading
            ? const Center(child: CircularProgressIndicator())
            : hasError
                ? Center(
                    child: Column(
                      mainAxisAlignment: MainAxisAlignment.center,
                      children: [
                        const Text(
                            "Failed to load symptoms. Please try again."),
                        const SizedBox(height: 10),
                        ElevatedButton(
                          onPressed: fetchSymptoms,
                          child: const Text("Retry"),
                        ),
                      ],
                    ),
                  )
                : ListView(
                    padding: const EdgeInsets.all(16.0),
                    children: [
                      Text(
                        'Welcome ${widget.username}!',
                        style: const TextStyle(
                          fontSize: 20,
                          fontWeight: FontWeight.bold,
                          color: Colors.teal,
                        ),
                      ),
                      const SizedBox(height: 10),
                      const Text(
                        'Select Symptoms:',
                        style: TextStyle(
                            fontSize: 20, fontWeight: FontWeight.bold),
                      ),
                      const SizedBox(height: 10),
                      ...symptoms.asMap().entries.map((entry) {
                        final index = entry.key;
                        final symptom = entry.value;
                        return Row(
                          children: [
                            Checkbox(
                              value: checkboxStates[index],
                              onChanged: (bool? value) {
                                setState(() {
                                  checkboxStates[index] = value ?? false;
                                  count += (value == true ? 1 : -1);
                                });
                              },
                            ),
                            Expanded(
                              child: Text(
                                symptom.name,
                                style: const TextStyle(
                                  fontSize: 16,
                                  fontWeight: FontWeight.bold,
                                ),
                              ),
                            ),
                          ],
                        );
                      }).toList(),
                      const SizedBox(height: 20),
                      Center(
                        child: ElevatedButton(
                          style: ElevatedButton.styleFrom(
                            backgroundColor: Colors.pink,
                            padding: const EdgeInsets.symmetric(
                                horizontal: 50, vertical: 20),
                            shape: RoundedRectangleBorder(
                              borderRadius: BorderRadius.circular(12),
                            ),
                          ),
                          onPressed: () {},
                          child: Text(
                            "Your Result: ${calculateResult(count)}",
                            style: const TextStyle(
                              fontSize: 18,
                              fontWeight: FontWeight.bold,
                              color: Colors.white,
                            ),
                            textAlign: TextAlign.center,
                          ),
                        ),
                      ),
                    ],
                  ),
      ),
    );
  }
}
