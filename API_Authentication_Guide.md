# دليل استخدام API المصادقة - Laravel Sanctum

## نظرة عامة
تم إنشاء نظام مصادقة كامل باستخدام Laravel Sanctum يوفر عمليات تسجيل الدخول والخروج وإدارة الرموز.

## المسارات المتاحة

### 1. تسجيل الدخول
```
POST /api/login
```

**البيانات المطلوبة:**
```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

**الاستجابة عند النجاح:**
```json
{
    "success": true,
    "message": "تم تسجيل الدخول بنجاح",
    "data": {
        "user": {
            "id": 1,
            "name": "اسم المستخدم",
            "email": "user@example.com"
        },
        "token": "1|abc123...",
        "token_type": "Bearer"
    }
}
```

### 2. تسجيل الخروج
```
POST /api/logout
Authorization: Bearer {token}
```

**الاستجابة:**
```json
{
    "success": true,
    "message": "تم تسجيل الخروج بنجاح"
}
```

### 3. تسجيل الخروج من جميع الأجهزة
```
POST /api/logout-all
Authorization: Bearer {token}
```

### 4. الحصول على معلومات المستخدم
```
GET /api/user
Authorization: Bearer {token}
```

**الاستجابة:**
```json
{
    "success": true,
    "data": {
        "user": {
            "id": 1,
            "name": "اسم المستخدم",
            "email": "user@example.com",
            "email_verified_at": null,
            "created_at": "2024-01-01T00:00:00.000000Z"
        }
    }
}
```

### 5. تجديد الرمز
```
POST /api/refresh-token
Authorization: Bearer {token}
```

### 6. عرض جميع الرموز النشطة
```
GET /api/tokens
Authorization: Bearer {token}
```

### 7. حذف رمز محدد
```
DELETE /api/tokens/{tokenId}
Authorization: Bearer {token}
```

## كيفية الاستخدام

### 1. تسجيل الدخول والحصول على الرمز
```javascript
// JavaScript Example
const response = await fetch('/api/login', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
        'Accept': 'application/json'
    },
    body: JSON.stringify({
        email: 'user@example.com',
        password: 'password123'
    })
});

const data = await response.json();
const token = data.data.token;

// حفظ الرمز في localStorage
localStorage.setItem('auth_token', token);
```

### 2. استخدام الرمز في الطلبات
```javascript
const token = localStorage.getItem('auth_token');

const response = await fetch('/api/user', {
    headers: {
        'Authorization': `Bearer ${token}`,
        'Accept': 'application/json'
    }
});
```

### 3. مثال cURL
```bash
# تسجيل الدخول
curl -X POST http://localhost:8000/api/login \
  -H "Content-Type: application/json" \
  -H "Accept: application/json" \
  -d '{"email":"user@example.com","password":"password123"}'

# استخدام الرمز
curl -X GET http://localhost:8000/api/user \
  -H "Authorization: Bearer 1|abc123..." \
  -H "Accept: application/json"
```

## رسائل الخطأ

### بيانات دخول خاطئة
```json
{
    "success": false,
    "message": "بيانات الدخول غير صحيحة"
}
```

### بيانات غير صحيحة
```json
{
    "success": false,
    "message": "بيانات غير صحيحة",
    "errors": {
        "email": ["البريد الإلكتروني مطلوب"],
        "password": ["كلمة المرور يجب أن تكون على الأقل 6 أحرف"]
    }
}
```

### رمز غير صحيح
```json
{
    "message": "Unauthenticated."
}
```

## الأمان

1. **تشفير كلمات المرور**: يتم تشفير كلمات المرور باستخدام Hash
2. **انتهاء صلاحية الرموز**: يمكن تعيين انتهاء صلاحية للرموز
3. **إدارة الرموز**: يمكن حذف رموز محددة أو جميع الرموز
4. **التحقق من البيانات**: يتم التحقق من صحة البيانات قبل المعالجة

## اختبار النظام

لتشغيل الاختبارات:
```bash
php artisan test tests/Feature/LoginControllerTest.php
```

## ملاحظات مهمة

1. تأكد من تثبيت Laravel Sanctum
2. قم بتشغيل migrations لإنشاء جداول الرموز
3. تأكد من إعداد CORS بشكل صحيح للتطبيقات الخارجية
4. احفظ الرموز بشكل آمن في التطبيق العميل
