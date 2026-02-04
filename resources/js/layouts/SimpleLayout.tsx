import { PropsWithChildren, ReactNode } from 'react';

export default function SimpleLayout({ header, children }: PropsWithChildren<{ header?: ReactNode }>) {
    return (
        <div className="min-h-screen bg-gray-100">
            {/* 簡易ヘッダー */}
            {header && (
                <header className="bg-white shadow">
                    <div className="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">{header}</div>
                </header>
            )}

            {/* メインコンテンツ */}
            <main>
                <div className="py-12">
                    <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">{children}</div>
                </div>
            </main>
        </div>
    );
}
