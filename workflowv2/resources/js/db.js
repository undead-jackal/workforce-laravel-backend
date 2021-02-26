import firebase from "firebase/app";
import "firebase/database";

const config = {
	apiKey: "AIzaSyBZs_Xb5EKddbQ2GDZ6NxDNUQvAKd5mQEc",
    authDomain: "workforce-cf75d.firebaseapp.com",
    projectId: "workforce-cf75d",
    storageBucket: "workforce-cf75d.appspot.com",
    messagingSenderId: "411606862559",
    appId: "1:411606862559:web:b9abef08380ffe0180b76a",
}

const db = firebase.initializeApp(config);
export default db;