import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import 'home1.dart';

class signin extends StatefulWidget {
  const signin({Key? key}) : super(key: key);

  @override
  State<signin> createState() => _signInState();
}

class _signInState extends State<signin> {
  final TextEditingController _usernameController = TextEditingController();
  final TextEditingController _passwordController = TextEditingController();
  final GlobalKey<FormState> _formKey = GlobalKey<FormState>();
  String _statusMessage = "";

  Future<void> _signInUser() async {
    final String apiUrl = "http://georgeclaritacsci410.atwebpages.com/signin.php";

    if (_formKey.currentState!.validate()) {
      final Map<String, String> data = {
        "username": _usernameController.text,
        "password": _passwordController.text,
      };

      try {
        final response = await http.post(
          Uri.parse(apiUrl),
          body: jsonEncode(data),
          headers: {"Content-Type": "application/json"},
        );

        if (response.statusCode == 200) {
          final responseBody = jsonDecode(response.body);

          if (responseBody['status'] == "success") {
            setState(() {
              _statusMessage = "Sign in successful!";
            });

            Navigator.of(context).push(
              MaterialPageRoute(
                builder: (context) => home1(username: _usernameController.text),
              ),
            );
          } else {
            setState(() {
              _statusMessage = responseBody['message'];
            });
          }
        } else {
          setState(() {
            _statusMessage = "Server error: ${response.statusCode}";
          });
        }
      } catch (e) {
        setState(() {
          _statusMessage = "Error: $e";
        });
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      debugShowCheckedModeBanner: false,
      home: Scaffold(
        appBar: AppBar(
          title: const Text(
            "Sign In",
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
        body: SingleChildScrollView(
          child: Padding(
            padding: const EdgeInsets.all(16.0),
            child: Form(
              key: _formKey,
              child: Column(
                children: [
                  const SizedBox(height: 16),
                  TextFormField(
                    controller: _usernameController,
                    decoration: const InputDecoration(
                      labelText: 'Username',
                      border: OutlineInputBorder(),
                    ),
                  ),
                  const SizedBox(height: 16),
                  TextFormField(
                    controller: _passwordController,
                    decoration: const InputDecoration(
                      labelText: 'Password',
                      border: OutlineInputBorder(),
                    ),
                    obscureText: true,
                  ),
                  const SizedBox(height: 24),
                  ElevatedButton(
                    style: ElevatedButton.styleFrom(
                      backgroundColor: Colors.blueAccent,
                      fixedSize: const Size(220, 50),
                      shape: RoundedRectangleBorder(
                        borderRadius: BorderRadius.circular(8),
                      ),
                    ),
                    onPressed: _signInUser,
                    child: const Text(
                      'Sign In',
                      style: TextStyle(fontSize: 18, color: Colors.white),
                    ),
                  ),
                  const SizedBox(height: 16),
                  Text(
                    _statusMessage,
                    style: const TextStyle(color: Colors.red),
                  ),
                ],
              ),
            ),
          ),
        ),
      ),
    );
  }
}
