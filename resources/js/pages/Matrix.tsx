
import { Head } from '@inertiajs/react';

import PermissionMatrix from '../components/PermissionMatrix';
import SimpleLayout from '../layouts/SimpleLayout';


// project は Laravel のコントローラーから Inertia::render で渡される
export default function Matrix({ project }: { project: any }) {
    return (
        // 1. レイアウト（ヘッダーやメニュー）で囲む
        <SimpleLayout header={<h2 className="text-xl font-semibold text-gray-800">権限マトリクス: {project.name}</h2>}>
            <Head title="権限マトリクス" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="bg-white p-6 shadow sm:rounded-lg">
                        {/* 2. ここで部品を呼び出す！ projectId を渡してあげる */}
                        <PermissionMatrix projectId={project.id} />
                    </div>
                </div>
            </div>
        </SimpleLayout>
    );
}
