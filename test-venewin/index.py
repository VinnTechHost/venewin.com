#!/usr/bin/python3

from flask import Flask, render_template
 
app = Flask(__name__)

@app.route('/')
def inicio():
    return render_template('inicio.html')
 
@app.route('/nomina')
def nomina():
    return render_template('nomina.html')

if __name__ == "__main__":
   app.run()
