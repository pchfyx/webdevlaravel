import { db } from './config';
import { 
  collection, 
  addDoc, 
  updateDoc, 
  deleteDoc, 
  doc, 
  getDoc, 
  getDocs, 
  query, 
  where 
} from 'firebase/firestore';

// Products CRUD
export const createProduct = (data) => addDoc(collection(db, 'products'), data);
export const updateProduct = (id, data) => updateDoc(doc(db, 'products', id), data);
export const deleteProduct = (id) => deleteDoc(doc(db, 'products', id));
export const getProduct = (id) => getDoc(doc(db, 'products', id));
export const getAllProducts = () => getDocs(collection(db, 'products'));

// Orders CRUD
export const createOrder = (data) => addDoc(collection(db, 'orders'), data);
export const updateOrder = (id, data) => updateDoc(doc(db, 'orders', id), data);
export const deleteOrder = (id) => deleteDoc(doc(db, 'orders', id));
export const getOrder = (id) => getDoc(doc(db, 'orders', id));
export const getUserOrders = (userId) => {
  const q = query(collection(db, 'orders'), where('userId', '==', userId));
  return getDocs(q);
};

// Users CRUD
export const createUser = (data) => addDoc(collection(db, 'users'), data);
export const updateUser = (id, data) => updateDoc(doc(db, 'users', id), data);
export const deleteUser = (id) => deleteDoc(doc(db, 'users', id));
export const getUser = (id) => getDoc(doc(db, 'users', id));
