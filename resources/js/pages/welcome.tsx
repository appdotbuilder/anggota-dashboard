import React, { useState } from 'react';
import { Eye, EyeOff, Bell, ArrowUpDown, ShoppingBag, CreditCard, Send, Home, BarChart3, Package, User } from 'lucide-react';

interface LoanItem {
    id: number;
    name: string;
    code: string | null;
    amount: string;
}

interface Transaction {
    id: number;
    title: string;
    subtitle: string | null;
    amount: string;
    type: 'income' | 'expense';
}

interface Product {
    id: number;
    name: string;
    price: string;
    status: 'promo' | 'baru' | 'regular';
}

interface Member {
    id: number;
    member_number: string;
    name: string;
    savings_pokok: string;
    savings_wajib: string;
    savings_sukarela: string;
    total_loans: string;
    notifications_count: number;
    loan_items: LoanItem[];
    transactions: Transaction[];
    total_savings: number;
}

interface Props {
    member: Member;
    promotionalProducts: Product[];
    [key: string]: unknown;
}

export default function Welcome({ member, promotionalProducts }: Props) {
    const [showSavingsAmount, setShowSavingsAmount] = useState(true);
    const [showLoansAmount, setShowLoansAmount] = useState(true);

    const formatCurrency = (amount: string | number) => {
        const num = typeof amount === 'string' ? parseFloat(amount) : amount;
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
        }).format(num).replace('IDR', 'Rp');
    };

    const totalSavings = parseFloat(member.savings_pokok) + parseFloat(member.savings_wajib) + parseFloat(member.savings_sukarela);

    return (
        <div className="min-h-screen bg-gray-50">
            {/* Header */}
            <div className="bg-white shadow-sm border-b">
                <div className="px-4 py-4">
                    <div className="flex items-center justify-between">
                        <div>
                            <h1 className="text-xl font-semibold text-gray-800">Halo, {member.name} 👋</h1>
                            <p className="text-sm text-gray-600">No. Anggota: {member.member_number}</p>
                        </div>
                        <div className="relative">
                            <Bell className="w-6 h-6 text-gray-600" />
                            {member.notifications_count > 0 && (
                                <span className="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">
                                    {member.notifications_count}
                                </span>
                            )}
                        </div>
                    </div>
                </div>
            </div>

            <div className="px-4 py-6 space-y-6">
                {/* Savings Card */}
                <div className="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div className="flex items-center justify-between mb-4">
                        <h2 className="text-lg font-semibold text-gray-800">💰 Total Simpanan</h2>
                        <button 
                            onClick={() => setShowSavingsAmount(!showSavingsAmount)}
                            className="p-2 text-gray-500 hover:text-gray-700"
                        >
                            {showSavingsAmount ? <Eye className="w-5 h-5" /> : <EyeOff className="w-5 h-5" />}
                        </button>
                    </div>
                    <div className="mb-4">
                        <p className="text-3xl font-bold text-green-600">
                            {showSavingsAmount ? formatCurrency(totalSavings) : '***'}
                        </p>
                    </div>
                    <div className="space-y-2">
                        <div className="flex justify-between items-center">
                            <span className="text-sm text-gray-600">Simpanan Pokok</span>
                            <span className="text-sm font-medium">
                                {showSavingsAmount ? formatCurrency(member.savings_pokok) : '***'}
                            </span>
                        </div>
                        <div className="flex justify-between items-center">
                            <span className="text-sm text-gray-600">Simpanan Wajib</span>
                            <span className="text-sm font-medium">
                                {showSavingsAmount ? formatCurrency(member.savings_wajib) : '***'}
                            </span>
                        </div>
                        <div className="flex justify-between items-center">
                            <span className="text-sm text-gray-600">Simpanan Sukarela</span>
                            <span className="text-sm font-medium">
                                {showSavingsAmount ? formatCurrency(member.savings_sukarela) : '***'}
                            </span>
                        </div>
                    </div>
                </div>

                {/* Loans Card */}
                <div className="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div className="flex items-center justify-between mb-4">
                        <h2 className="text-lg font-semibold text-gray-800">🏦 Total Pinjaman</h2>
                        <button 
                            onClick={() => setShowLoansAmount(!showLoansAmount)}
                            className="p-2 text-gray-500 hover:text-gray-700"
                        >
                            {showLoansAmount ? <Eye className="w-5 h-5" /> : <EyeOff className="w-5 h-5" />}
                        </button>
                    </div>
                    <div className="mb-4">
                        <p className="text-3xl font-bold text-red-600">
                            {showLoansAmount ? formatCurrency(member.total_loans) : '***'}
                        </p>
                    </div>
                    <div className="space-y-2">
                        {member.loan_items.map((loan) => (
                            <div key={loan.id} className="flex justify-between items-center">
                                <span className="text-sm text-gray-600">{loan.name}</span>
                                <span className="text-sm font-medium">
                                    {showLoansAmount ? formatCurrency(loan.amount) : '***'}
                                </span>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Main Menu Buttons */}
                <div className="grid grid-cols-4 gap-4">
                    <button className="bg-green-500 text-white rounded-2xl p-4 flex flex-col items-center justify-center space-y-2 hover:bg-green-600 transition-colors">
                        <ArrowUpDown className="w-6 h-6" />
                        <span className="text-xs font-medium">Mutasi</span>
                    </button>
                    <button className="bg-yellow-500 text-white rounded-2xl p-4 flex flex-col items-center justify-center space-y-2 hover:bg-yellow-600 transition-colors">
                        <ShoppingBag className="w-6 h-6" />
                        <span className="text-xs font-medium">Produk</span>
                    </button>
                    <button className="bg-red-500 text-white rounded-2xl p-4 flex flex-col items-center justify-center space-y-2 hover:bg-red-600 transition-colors">
                        <CreditCard className="w-6 h-6" />
                        <span className="text-xs font-medium">Bayar</span>
                    </button>
                    <button className="bg-blue-500 text-white rounded-2xl p-4 flex flex-col items-center justify-center space-y-2 hover:bg-blue-600 transition-colors">
                        <Send className="w-6 h-6" />
                        <span className="text-xs font-medium">Transfer</span>
                    </button>
                </div>

                {/* Recent Transactions */}
                <div className="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h2 className="text-lg font-semibold text-gray-800 mb-4">📊 Mutasi Terakhir</h2>
                    <div className="space-y-4">
                        {member.transactions.map((transaction) => (
                            <div key={transaction.id} className="flex items-center justify-between">
                                <div className="flex-1">
                                    <p className="text-sm font-medium text-gray-800">{transaction.title}</p>
                                    {transaction.subtitle && (
                                        <p className="text-xs text-gray-500">{transaction.subtitle}</p>
                                    )}
                                </div>
                                <div className={`text-sm font-semibold ${
                                    transaction.type === 'income' ? 'text-green-600' : 'text-red-600'
                                }`}>
                                    {transaction.type === 'income' ? '+' : '-'}{formatCurrency(transaction.amount)}
                                </div>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Product Promotions */}
                <div className="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h2 className="text-lg font-semibold text-gray-800 mb-4">🎁 Promo Produk</h2>
                    <div className="space-y-4">
                        {promotionalProducts.map((product) => (
                            <div key={product.id} className="flex items-center justify-between">
                                <div className="flex-1">
                                    <p className="text-sm font-medium text-gray-800">{product.name}</p>
                                    <p className="text-sm font-semibold text-blue-600">{formatCurrency(product.price)}</p>
                                </div>
                                <div className="flex items-center">
                                    <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                                        product.status === 'promo'
                                            ? 'bg-red-100 text-red-600'
                                            : product.status === 'baru'
                                            ? 'bg-green-100 text-green-600'
                                            : 'bg-gray-100 text-gray-600'
                                    }`}>
                                        {product.status === 'promo' ? 'Promo' : product.status === 'baru' ? 'Baru' : 'Regular'}
                                    </span>
                                </div>
                            </div>
                        ))}
                    </div>
                </div>

                {/* Bottom padding for navigation */}
                <div className="h-20"></div>
            </div>

            {/* Bottom Navigation */}
            <div className="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 px-4 py-2">
                <div className="grid grid-cols-4 gap-4">
                    <button className="flex flex-col items-center justify-center py-2 text-blue-600">
                        <Home className="w-5 h-5" />
                        <span className="text-xs mt-1">Home</span>
                    </button>
                    <button className="flex flex-col items-center justify-center py-2 text-gray-500">
                        <BarChart3 className="w-5 h-5" />
                        <span className="text-xs mt-1">Mutasi</span>
                    </button>
                    <button className="flex flex-col items-center justify-center py-2 text-gray-500">
                        <Package className="w-5 h-5" />
                        <span className="text-xs mt-1">Produk</span>
                    </button>
                    <button className="flex flex-col items-center justify-center py-2 text-gray-500">
                        <User className="w-5 h-5" />
                        <span className="text-xs mt-1">Profil</span>
                    </button>
                </div>
            </div>
        </div>
    );
}