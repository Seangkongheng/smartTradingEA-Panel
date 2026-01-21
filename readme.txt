***Login Process:
1. User registers
2. User logs in with email + password
3. Backend sends email verification link (UUID + expiry)
4. User clicks email → verify token and expiry
5. If verified → JWT issued → user redirected to dashboard
6. If token invalid/expired → show verification failed
