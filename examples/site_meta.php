<?php

/**
 * SiteMeta - 站点元信息管理工具
 * 用于存储和管理网站元数据，并生成描述性文本。
 */

class SiteMeta
{
    /**
     * 站点元数据数组
     */
    private array $meta = [
        'title'       => '爱游戏',
        'description' => '提供优质游戏资讯与互动社区',
        'url'         => 'https://official-m-aiyouxi.com.cn',
        'keywords'    => ['爱游戏', '游戏资讯', '玩家社区'],
        'author'      => '爱游戏团队',
        'language'    => 'zh-CN',
        'version'     => '1.0.0',
    ];

    /**
     * 构造函数
     * 可选传入自定义元数据覆盖默认值
     *
     * @param array $customMeta 自定义元数据
     */
    public function __construct(array $customMeta = [])
    {
        if (!empty($customMeta)) {
            $this->meta = array_merge($this->meta, $customMeta);
        }
    }

    /**
     * 获取完整的元数据数组
     *
     * @return array
     */
    public function getAllMeta(): array
    {
        return $this->meta;
    }

    /**
     * 生成简短的站点描述文本
     * 格式：标题 - 描述 (关键词1, 关键词2, ...)
     *
     * @param int $maxKeywords 最多显示的关键词数量，默认全部
     * @return string
     */
    public function generateShortDescription(int $maxKeywords = 3): string
    {
        $title = $this->getTitle();
        $description = $this->getDescription();
        $keywords = $this->getKeywords();

        // 限制关键词数量
        if ($maxKeywords > 0 && count($keywords) > $maxKeywords) {
            $keywords = array_slice($keywords, 0, $maxKeywords);
        }

        $keywordStr = implode(', ', $keywords);

        // 构建描述文本
        if (!empty($keywordStr)) {
            return htmlspecialchars("{$title} - {$description} ({$keywordStr})", ENT_QUOTES, 'UTF-8');
        }

        return htmlspecialchars("{$title} - {$description}", ENT_QUOTES, 'UTF-8');
    }

    /**
     * 获取站点标题
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->meta['title'] ?? '';
    }

    /**
     * 获取站点描述
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->meta['description'] ?? '';
    }

    /**
     * 获取关键词列表
     *
     * @return array
     */
    public function getKeywords(): array
    {
        return $this->meta['keywords'] ?? [];
    }

    /**
     * 获取站点URL
     *
     * @return string
     */
    public function getUrl(): string
    {
        return $this->meta['url'] ?? '';
    }

    /**
     * 输出示例：展示如何使用该类
     */
    public static function demo(): void
    {
        // 使用默认配置
        $siteMeta = new self();
        echo $siteMeta->generateShortDescription() . "\n";

        // 使用自定义配置
        $custom = [
            'title'       => '爱游戏社区',
            'description' => '玩家聚集地，分享游戏乐趣',
            'keywords'    => ['爱游戏', '游戏社区', '玩家交流'],
        ];
        $customMeta = new self($custom);
        echo $customMeta->generateShortDescription(2) . "\n";
    }
}

// 如果直接运行此文件，执行演示
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    SiteMeta::demo();
}