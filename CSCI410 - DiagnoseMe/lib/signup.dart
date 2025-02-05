import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

import 'home1.dart';

class signup extends StatefulWidget {
  const signup({Key? key}) : super(key: key);

  @override
  State<signup> createState() => _signupState();
}

class _signupState extends State<signup> {
  String _username = '';
  String _email = '';
  String _password = '';
  String _gender = '';
  String _phone = '';
  String _age = '';

  void updateName(String text) => setState(() => _username = text);
  void updateEmail(String text) => setState(() => _email = text);
  void updatePassword(String text) => setState(() => _password = text);
  void updatePhone(String text) => setState(() => _phone = text);
  void updateAge(String text) => setState(() => _age = text);
  void updateGender(String value) => setState(() => _gender = value);

  final _formKey = GlobalKey<FormState>();
  final List<int> _ages = [];

  void setAge() {
    for (int i = 18; i < 40; i++) {
      _ages.add(i);
    }
  }

  @override
  void initState() {
    super.initState();
    setAge();
  }

  void _signupUser() async {
    final url =
        Uri.parse("http://georgeclaritacsci410.atwebpages.com/signup.php");

    if (_formKey.currentState!.validate()) {
      final data = {
        "name": _username,
        "email": _email,
        "age": _age,
        "gender": _gender,
        "phone": _phone,
        "password": _password,
      };

      try {
        final response = await http.post(
          url,
          body: jsonEncode(data),
          headers: {"Content-Type": "application/json"},
        );

        if (response.statusCode == 200) {
          final responseBody = jsonDecode(response.body);
          if (responseBody['success'] == true) {
            if (mounted) {
              ScaffoldMessenger.of(context).showSnackBar(
                const SnackBar(content: Text('Signup successful!')),
              );
              Navigator.of(context).push(
                MaterialPageRoute(
                  builder: (context) => home1(username: _username),
                ),
              );
            }
          } else {
            if (mounted) {
              ScaffoldMessenger.of(context).showSnackBar(
                SnackBar(
                  content:
                      Text(responseBody['error'] ?? 'Unknown error occurred'),
                ),
              );
            }
          }
        } else {
          if (mounted) {
            ScaffoldMessenger.of(context).showSnackBar(
              SnackBar(content: Text('Server error: ${response.statusCode}')),
            );
          }
        }
      } catch (e) {
        if (mounted) {
          ScaffoldMessenger.of(context).showSnackBar(
            SnackBar(content: Text('Error: $e')),
          );
        }
      }
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text(
          "Sign Up",
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
                  decoration: const InputDecoration(
                    labelText: 'Username',
                    border: OutlineInputBorder(),
                  ),
                  onChanged: updateName,
                ),
                const SizedBox(height: 16),
                TextFormField(
                  decoration: const InputDecoration(
                    labelText: 'Email',
                    border: OutlineInputBorder(),
                  ),
                  keyboardType: TextInputType.emailAddress,
                  onChanged: updateEmail,
                ),
                const SizedBox(height: 16),
                DropdownButtonFormField<String>(
                  decoration: const InputDecoration(
                    labelText: 'Age',
                    border: OutlineInputBorder(),
                  ),
                  value: _age.isEmpty ? null : _age,
                  items: _ages
                      .map((age) => DropdownMenuItem<String>(
                            value: age.toString(),
                            child: Text(age.toString()),
                          ))
                      .toList(),
                  onChanged: (value) {
                    updateAge(value ?? '');
                  },
                ),
                const SizedBox(height: 16),
                const Align(
                  alignment: Alignment.centerLeft,
                  child: Text(
                    "Gender:",
                    style: TextStyle(
                      fontSize: 16,
                      fontWeight: FontWeight.bold,
                    ),
                  ),
                ),
                Row(
                  children: [
                    Expanded(
                      child: RadioListTile<String>(
                        title: const Text("Male"),
                        value: "Male",
                        groupValue: _gender,
                        onChanged: (value) {
                          if (value != null) {
                            updateGender(value);
                          }
                        },
                      ),
                    ),
                    Expanded(
                      child: RadioListTile<String>(
                        title: const Text("Female"),
                        value: "Female",
                        groupValue: _gender,
                        onChanged: (value) {
                          if (value != null) {
                            updateGender(value);
                          }
                        },
                      ),
                    ),
                  ],
                ),
                const SizedBox(height: 16),
                TextFormField(
                  decoration: const InputDecoration(
                    labelText: 'Phone Number',
                    border: OutlineInputBorder(),
                  ),
                  keyboardType: TextInputType.phone,
                  onChanged: updatePhone,
                ),
                const SizedBox(height: 24),
                TextFormField(
                  decoration: const InputDecoration(
                    labelText: 'Password',
                    border: OutlineInputBorder(),
                  ),
                  obscureText: true,
                  onChanged: updatePassword,
                ),
                const SizedBox(height: 16),
                ElevatedButton(
                  style: ElevatedButton.styleFrom(
                    backgroundColor: const Color.fromARGB(255, 66, 205, 138),
                    fixedSize: const Size(220, 50),
                    shape: RoundedRectangleBorder(
                      borderRadius: BorderRadius.circular(8),
                    ),
                  ),
                  onPressed: _signupUser,
                  child: const Text(
                    'Sign Up',
                    style: TextStyle(fontSize: 18, color: Colors.white),
                  ),
                ),
              ],
            ),
          ),
        ),
      ),
    );
  }
}
