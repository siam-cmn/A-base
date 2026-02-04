import axios from 'axios';
import React, { useEffect, useState } from 'react';

// 1. 「どんな形のデータが届くか」を定義します（型定義）
interface Api { id: number; summary: string; method: string; }
interface Role {
    id: number;
    name: string;
    allowed_apis: { id: number }[]; // 権限を持っているAPIのIDリスト
}

export default function PermissionMatrix({ projectId }: { projectId: number }) {
    // 2. データを保存しておく「箱」を作ります（State）
    const [apis, setApis] = useState<Api[]>([]);
    const [roles, setRoles] = useState<Role[]>([]);
    const [loading, setLoading] = useState(true);

    // 3. 画面が開いた瞬間に「一度だけ」実行する処理（Effect）
    useEffect(() => {
        // Laravelで作ったAPIを叩く
        axios.get(`/api/projects/${projectId}/matrix`)
            .then(response => {
                // 返ってきたJSONを「箱」に入れる
                setApis(response.data.apis);
                setRoles(response.data.role); // Laravel側が role なので合わせる
                setLoading(false);
            })
            .catch(error => {
                console.error("データの取得に失敗しました", error);
                setLoading(false);
            });
    }, [projectId]); // projectIdが変わったら再実行する

    if (loading) return <div>データを読み込み中...</div>;

    // 4. 見た目（HTML/JSX）を返します
    return (
        <div className="overflow-x-auto">
            <table className="min-w-full border-collapse border border-gray-200">
                <thead>
                <tr className="bg-gray-50">
                    <th className="border p-2">APIリスト</th>
                    {roles.map(role => (
                        <th key={role.id} className="border p-2">{role.name}</th>
                    ))}
                </tr>
                </thead>
                <tbody>
                {apis.map(api => (
                    <tr key={api.id} className="hover:bg-gray-50">
                        <td className="border p-2 text-sm">
                            <span className="font-bold">{api.summary}</span>
                            <span className="ml-2 text-xs text-gray-400">{api.method}</span>
                        </td>
                        {roles.map(role => {
                            // ここでチェックが入るかどうかを判定
                            const isAllowed = role.allowed_apis.some(a => a.id === api.id);
                            return (
                                <td key={role.id} className="border p-2 text-center">
                                    <input
                                        type="checkbox"
                                        checked={isAllowed}
                                        readOnly
                                    />
                                </td>
                            );
                        })}
                    </tr>
                ))}
                </tbody>
            </table>
        </div>
    );
}
