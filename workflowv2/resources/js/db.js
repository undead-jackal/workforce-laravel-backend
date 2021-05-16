import firebase from "firebase/app";
import "firebase/database";

const config = {
    apiKey: "AIzaSyCHTBaf4RbRBZQ_hJdtJtR9qDe3C6bsI9E",
    authDomain: "workforce-bf685.firebaseapp.com",
    projectId: "workforce-bf685",
    storageBucket: "workforce-bf685.appspot.com",
    messagingSenderId: "403695085064",
    appId: "1:403695085064:web:ce521fd9694563121493bd"
}

const db = firebase.initializeApp(config);
export default db;