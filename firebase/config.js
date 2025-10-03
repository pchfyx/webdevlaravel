import { initializeApp } from "firebase/app";
import { getAnalytics } from "firebase/analytics";
import { getAuth } from "firebase/auth";
import { getFirestore } from "firebase/firestore";
import { getDatabase } from "firebase/database";
import { getStorage } from "firebase/storage";

const firebaseConfig = {
  apiKey: "AIzaSyAXBDwjo_2yaPx1eH1UPAlFFsn-gbURp94",
  authDomain: "onlineshoppy-cloudcomp.firebaseapp.com",
  databaseURL: "https://onlineshoppy-cloudcomp-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "onlineshoppy-cloudcomp",
  storageBucket: "onlineshoppy-cloudcomp.firebasestorage.app",
  messagingSenderId: "984478669355",
  appId: "1:984478669355:web:6a9b2ee65a3a03fef2e86e",
  measurementId: "G-HS7G8NSN3F"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);
const analytics = getAnalytics(app);

// Initialize Firebase services
export const auth = getAuth(app);
export const db = getFirestore(app);
export const rtdb = getDatabase(app);
export const storage = getStorage(app);

export { app, analytics };
