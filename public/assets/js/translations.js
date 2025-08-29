/**
 * JavaScript Translation Helper
 * Provides translations for JavaScript files
 */

// Get the current language from the HTML lang attribute or default to 'en'
function getCurrentLanguage() {
    return document.documentElement.lang || 'en';
}

// Translation object
const translations = {
    en: {
        // Common actions
        actions: 'Actions',
        edit: 'Edit',
        delete: 'Delete',
        cancel: 'Cancel',
        cancel_it: 'Yes, Cancel it',
        yes_delete: 'Yes, Delete!',
        return: 'No Return',
        confirm: 'Confirm',
        ok: 'OK',
        got_it: 'Got it!',
        try_again: 'Try Again',
        close: 'Close',

        // Confirmation messages
        are_you_sure: 'Are you sure?',
        confirm_delete: 'Are you sure you want to delete this item?',
        confirm_cancel: 'Are you sure you would like to cancel?',
        action_cannot_be_undone: 'This action cannot be undone!',

        // Success messages
        operation_successful: 'Operation completed successfully!',
        data_saved: 'Data saved successfully!',
        data_updated: 'Data updated successfully!',
        data_deleted: 'Data deleted successfully!',
        form_submitted: 'Form has been successfully submitted!',

        // Error messages
        operation_failed: 'Operation failed!',
        error_occurred: 'An error occurred!',
        validation_failed: 'Sorry, looks like there are some errors detected, please try again.',
        form_not_cancelled: 'Your form has not been cancelled!',

        // User specific
        user_delete_confirm: 'Are you sure you want to delete this user?',
        users_delete_confirm: 'Are you sure you want to delete selected users?',
        user_deleted: 'User has been deleted successfully!',
        users_deleted: 'You have deleted all selected users!',
        users_not_deleted: 'Selected users were not deleted.',
        user_remove_confirm: 'Are you sure you want to remove {user} from the role?',
        user_removed: '{user} has been removed from the role!',
        user_remove_failed: 'Failed to remove {user} from the role.',

        // Role specific
        role_delete_confirm: 'Are you sure you want to delete this role?',
        role_updated: 'Role and permissions have been successfully updated!',
        role_update_failed: 'Failed to update role and permissions.',
        role_saving_error: 'Error saving role. Please try again.',

        // Permission specific
        permission_delete_confirm: 'Are you sure you want to delete {permission}?',

        // General
        please_fix_errors: 'Please fix the errors and try again.',
        processing_error: 'Error occurred while processing your request.',
    },
    ar: {
        // Common actions
        actions: 'الإجراءات',
        edit: 'تعديل',
        delete: 'حذف',
        cancel: 'إلغاء',
        cancel_it: 'نعم, إلغ',
        yes_delete: 'نعم, احذف!',
        return: 'لا تراجع',
        confirm: 'تأكيد',
        ok: 'موافق',
        got_it: 'فهمت!',
        try_again: 'حاول مرة أخرى',
        close: 'إغلاق',

        // Confirmation messages
        are_you_sure: 'هل أنت متأكد؟',
        confirm_delete: 'هل أنت متأكد من حذف هذا العنصر؟',
        confirm_cancel: 'هل أنت متأكد من الإلغاء؟',
        action_cannot_be_undone: 'لا يمكن التراجع عن هذا الإجراء!',

        // Success messages
        operation_successful: 'تمت العملية بنجاح!',
        data_saved: 'تم حفظ البيانات بنجاح!',
        data_updated: 'تم تحديث البيانات بنجاح!',
        data_deleted: 'تم حذف البيانات بنجاح!',
        form_submitted: 'تم إرسال النموذج بنجاح!',

        // Error messages
        operation_failed: 'فشلت العملية!',
        error_occurred: 'حدث خطأ!',
        validation_failed: 'عذراً، يبدو أن هناك أخطاء. يرجى المحاولة مرة أخرى.',
        form_not_cancelled: 'لم يتم إلغاء النموذج!',

        // User specific
        user_delete_confirm: 'هل أنت متأكد من حذف هذا المستخدم؟',
        users_delete_confirm: 'هل أنت متأكد من حذف المستخدمين المحددين؟',
        user_deleted: 'تم حذف المستخدم بنجاح!',
        users_deleted: 'تم حذف جميع المستخدمين المحددين!',
        users_not_deleted: 'لم يتم حذف المستخدمين المحددين.',
        user_remove_confirm: 'هل أنت متأكد من إزالة {user} من الدور؟',
        user_removed: 'تم إزالة {user} من الدور!',
        user_remove_failed: 'فشل في إزالة {user} من الدور.',

        // Role specific
        role_delete_confirm: 'هل أنت متأكد من حذف هذا الدور؟',
        role_updated: 'تم تحديث الدور والصلاحيات بنجاح!',
        role_update_failed: 'فشل في تحديث الدور والصلاحيات.',
        role_saving_error: 'خطأ في حفظ الدور. يرجى المحاولة مرة أخرى.',

        // Permission specific
        permission_delete_confirm: 'هل أنت متأكد من حذف صلاحية {permission}؟',

        // General
        please_fix_errors: 'يرجى إصلاح الأخطاء والمحاولة مرة أخرى.',
        processing_error: 'حدث خطأ أثناء معالجة طلبك.',
    }
};

/**
 * Get translation for a given key
 * @param {string} key - Translation key
 * @param {object} replacements - Object with replacement values
 * @returns {string} - Translated string
 */
function __(key, replacements) {
    try {
        if (typeof replacements === 'undefined') {
            replacements = {};
        }

        const lang = getCurrentLanguage();
        let translation = translations[lang] && translations[lang][key]
            ? translations[lang][key]
            : translations.en[key] || key;

        // Replace placeholders with actual values
        if (replacements && Object.keys && Object.keys(replacements).length > 0) {
            Object.keys(replacements).forEach(function(placeholder) {
                translation = translation.replace('{' + placeholder + '}', replacements[placeholder]);
            });
        }

        return translation;
    } catch (error) {
        console.error('Translation error:', error);
        return key; // Return the key as fallback
    }
}

/**
 * Get current language direction
 * @returns {string} - 'rtl' or 'ltr'
 */
function getLanguageDirection() {
    return getCurrentLanguage() === 'ar' ? 'rtl' : 'ltr';
}

/**
 * Check if current language is RTL
 * @returns {boolean}
 */
function isRTL() {
    return getCurrentLanguage() === 'ar';
}

// Make functions available globally
window.__ = __;
window.getLanguageDirection = getLanguageDirection;
window.isRTL = isRTL;

// Initialize and verify
document.addEventListener('DOMContentLoaded', function() {
    // console.log('Translation system loaded. Current language:', getCurrentLanguage());
    // console.log('Translation function available:', typeof window.__ === 'function');
});
