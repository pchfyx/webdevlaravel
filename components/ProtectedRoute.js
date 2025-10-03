import { useAuth } from './AuthProvider';
import { Navigate } from 'react-router-dom';

export function ProtectedRoute({ children }) {
  const { user } = useAuth();

  if (!user || !user.emailVerified) {
    return <Navigate to="/login" />;
  }

  return children;
}
