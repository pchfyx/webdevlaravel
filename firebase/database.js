import { ref, set, get, push, remove, update } from 'firebase/database';
import { db } from './config';

// Products
export const addProduct = (product) => {
  const productRef = ref(db, 'products/' + push(ref(db, 'products')).key);
  return set(productRef, product);
};

export const getProducts = () => {
  return get(ref(db, 'products'));
};

// Orders
export const createOrder = (order) => {
  const orderRef = ref(db, 'orders/' + push(ref(db, 'orders')).key);
  return set(orderRef, order);
};

export const getOrders = () => {
  return get(ref(db, 'orders'));
};

// Users
export const updateUser = (userId, data) => {
  const userRef = ref(db, 'users/' + userId);
  return update(userRef, data);
};

export const getUser = (userId) => {
  return get(ref(db, 'users/' + userId));
};
